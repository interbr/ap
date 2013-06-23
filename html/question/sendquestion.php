<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
require_once(__ROOT__.'/../php/answering-system.php'); //a file with etherpad-api-class
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionToSend = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$dbhandle->real_escape_string($_GET["id"])."'");
while($questionrow = $questionToSend->fetch_assoc()) {
$questionfile = "../../content/".$questionrow['questionID'].".txt"; //questionfile
$questionSubject = strip_tags($questionrow['subject']);
$categories = strip_tags($questionrow['questionCategories']);
$questionIDfromDB = strip_tags($questionrow['questionID']);
$timeofsending = strip_tags($questionrow['time-of-sending']);
$questionverified = $questionrow['active'];
$questionsent = $questionrow['sent'];
};
if ( $questionverified == '1' ) {
if ( $questionsent != '1') {
require_once (__ROOT__.'/../php/class.phpmailer.php');
$writeSent = "UPDATE questions SET sent = '1' WHERE questionID = '".$dbhandle->real_escape_string($_GET["id"])."'";
$dbhandle->query($writeSent);
$agentspool = $dbhandle->query("SELECT * FROM agents WHERE (active='1') ORDER BY RAND() LIMIT 0,5");
$agentsresult = array();
$counter = 1;
while ($agentrow = mysqli_fetch_array($agentspool)) {
    $agentsresult["agent".$counter] = $agentrow["email"];
    $counter = $counter + 1;
}
$timetoanswer = time() + 5400;
$timedisplay = date('c',$timetoanswer);
$timetomeet = time() + 1800;
$timetomeetdisplay = gmdate('D, H:i:s',$timetomeet);

extract($agentsresult);

$subject = "Test-Question: ".strip_tags($_GET["id"])." Subject: ".strip_tags($questionSubject);
$msg = strip_tags(file_get_contents($questionfile));
$receipients = array(
	'agent1' => $agent1,
    'agent2' => $agent2,
	'agent3' => $agent3,
	'agent4' => $agent4,
	'agent5' => $agent5);

///////////////////////////////////////////////// ETHERPAD

$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadhost"].'/api');
try {
  $createGroup = $instance->createGroup();
  $groupID = $createGroup->groupID;
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "Etherpad-Error (createGroup)";
}

/* Example: Create Group Pad */
try {
  $newPad = $instance->createGroupPad($groupID,$_GET["id"],'This is our Answer: '); 
  $padID = $newPad->padID;
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "Etherpad-Error (createGroupPad)";
}

$writePadData = "INSERT INTO answer_access (questionID, groupID, padID, timetoanswerSession) VALUES ('".$dbhandle->real_escape_string($_GET["id"])."','".$dbhandle->real_escape_string($groupID)."','".$dbhandle->real_escape_string($padID)."','".$dbhandle->real_escape_string($timetoanswer)."') ON DUPLICATE KEY UPDATE groupID=VALUES(groupID), padID=VALUES(padID), timetoanswerSession=VALUES(timetoanswerSession)";
$dbhandle->query($writePadData);
$writeAnswerSystemData = "INSERT INTO answer_start_system (questionID) VALUES ('".$dbhandle->real_escape_string($_GET["id"])."')";
$dbhandle->query($writeAnswerSystemData);

$writeQuestionAnswerAgentsID = "INSERT INTO question_answer_agents (questionID) VALUES ('".$dbhandle->real_escape_string($_GET["id"])."')";
$dbhandle->query($writeQuestionAnswerAgentsID);

// mail settings

foreach ($receipients as $agentcode => $agentaddress) {
	$query_pcode = $dbhandle->query("SELECT * FROM agents WHERE email='".$agentaddress."' LIMIT 1");
    while($pcode_row = $query_pcode->fetch_assoc()) {
	$pcodesend = $pcode_row['pcode'];
};
try {
  $author = $instance->createAuthor($agentaddress); // This really needs explaining..
  $authorID = $author->authorID;
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "Etherpad-Error (createAuthor)";
}
// try {
  // $authormap = $instance->createAuthorIfNotExistsFor($agentaddress, $agentcode); 
  // $authorID = $authormap->authorID;
  // echo "The AuthorID is now $authorID\n\n";
// } catch (Exception $e) {
  // echo "\n\ncreateAuthorIfNotExistsFor Failed with message ". $e->getMessage();
// }
$sessionID = $instance->createSession($groupID, $authorID, $timetoanswer);
$agentsessionID = $sessionID->sessionID;

// send mail

//Create a new PHPMailer instance
$mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
$mail->IsSendmail();
//Set who the message is to be sent from
$mail->SetFrom('no-reply@amored-police.com', 'idea.amored-police.com question-answer-system');
//Set an alternative reply-to address
$mail->AddReplyTo('no-reply@amored-police.com','idea.amored-police.com question-answer-system');
//Set who the message is to be sent to
$mail->AddAddress($agentaddress);
$mail->AddBCC('testing@t-cup.tv');
//Set the subject line
$mail->Subject = $subject;
$mail->IsHTML(false);
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->Body = 'You just received a question!

It has the subject: '.$questionSubject.'
It is sorted to the following categories: '.$categories.'

The Question is:
'.$msg.'

You and the other four agents who received this question will have 90 minutes to answer this question. Why not meet in 30 minutes (GMT '.$timetomeetdisplay.')?
GMT (Greenwich mean time) is i.e. Berlin-time -2, Chicago-time +6, Hong-Kong-time -8 ...

Follow this link to answer the question: '.$GLOBALS["aphost"].'/answer/index.php?id='.$questionIDfromDB.'&agentcode='.$agentcode.'&authorID='.$authorID.'

If you have no time to answer the question: '.$GLOBALS["aphost"].'/forward/forward.php?id='.$questionIDfromDB.'&agentcode='.$agentcode.'&authorID='.$authorID.'


If you want to pause your account, follow this link: '.$GLOBALS["aphost"].'/agentstatus/change.php?email='.urlencode($agentaddress).'&pcode='.$pcodesend.'&status=0
If at any time you want to reactivate your account: '.$GLOBALS["aphost"].'/agentstatus/change.php?email='.urlencode($agentaddress).'&pcode='.$pcodesend.'&status=1
If you want to delete your account: '.$GLOBALS["aphost"].'/agentstatus/deleteaccount.php?email='.urlencode($agentaddress).'&pcode='.$pcodesend.'&delete=1

For questions regarding this question-answer-system or suggestions, please feel free to write to felix_longolius@amored-police.org';

//Send the message, check for errors
if(!$mail->Send()) {
  echo "<div class=\"textdiv\">Mailer Error: " . $mail->ErrorInfo . "</div>";
} else {
  echo "<div class=\"textdiv\">Message sent to ".$agentcode."!</div>";
}
$writePadDataAgents = "UPDATE answer_access SET $agentcode = '".$dbhandle->real_escape_string($authorID)."', ".$dbhandle->real_escape_string($agentcode)."sessionID = '".$dbhandle->real_escape_string($agentsessionID)."' WHERE questionID = '".$dbhandle->real_escape_string($_GET["id"])."'";
$dbhandle->query($writePadDataAgents);
$writeQuestionAnswerAgents = "UPDATE question_answer_agents SET agents = IFNULL(CONCAT(agents, ',".$dbhandle->real_escape_string($agentaddress)."'), '".$dbhandle->real_escape_string($agentaddress)."') WHERE questionID = '".$dbhandle->real_escape_string($_GET["id"])."'";
$dbhandle->query($writeQuestionAnswerAgents);
}
}
else {
echo "<div class=\"textdiv\">Already sent</div>"; };
}
else {
echo "<div class=\"textdiv\">Not varified</div>"; };
$dbhandle->close();
?>