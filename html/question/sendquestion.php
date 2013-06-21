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
$writeSent = "UPDATE questions SET sent = '1' WHERE questionID = '".$dbhandle->real_escape_string($_GET["id"])."'";
$dbhandle->query($writeSent);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
$agentspool = $dbhandle->query("SELECT * FROM agents WHERE (active='1') ORDER BY RAND() LIMIT 0,5");
$agentsresult = array();
$counter = 1;
while ($agentrow = mysqli_fetch_array($agentspool)) {
    $agentsresult["agent".$counter] = $agentrow["email"];
    $counter = $counter + 1;
}
$timetoanswer = time() + 3600;
$timedisplay = date('c',$timetoanswer);

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
  echo "New GroupID is $groupID\n\n";
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "\n\ncreateGroup Failed with message ". $e->getMessage();
}

/* Example: Create Group Pad */
try {
  $newPad = $instance->createGroupPad($groupID,$_GET["id"],'This is our Answer: '); 
  $padID = $newPad->padID;
  echo "Created new pad with padID: $padID\n\n";
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "\n\ncreateGroupPad Failed with message ". $e->getMessage();
}

$writePadData = "INSERT INTO answer_access (questionID, groupID, padID, timetoanswerSession) VALUES ('".$dbhandle->real_escape_string($_GET["id"])."','".$dbhandle->real_escape_string($groupID)."','".$dbhandle->real_escape_string($padID)."','".$dbhandle->real_escape_string($timetoanswer)."') ON DUPLICATE KEY UPDATE groupID=VALUES(groupID), padID=VALUES(padID), timetoanswerSession=VALUES(timetoanswerSession)";
$dbhandle->query($writePadData);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
$writeAnswerSystemData = "INSERT INTO answer_start_system (questionID) VALUES ('".$dbhandle->real_escape_string($_GET["id"])."')";
$dbhandle->query($writeAnswerSystemData);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";


// mail settings
$headers = "From: no-reply@amored-police.org\r\n" .
	"Reply-To: no-reply@amored-police.org\r\n" .
    "Content-type:  text/plain; charset=utf-8\r\n" ;
foreach ($receipients as $agentcode => $agentaddress) {
	$query_pcode = $dbhandle->query("SELECT * FROM agents WHERE email='".$agentaddress."' LIMIT 1");
    while($pcode_row = $query_pcode->fetch_assoc()) {
	$pcodesend = $pcode_row['pcode'];
};
try {
  $author = $instance->createAuthor($agentaddress); // This really needs explaining..
  $authorID = $author->authorID;
echo "The AuthorID is now $authorID\n\n";
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "\n\ncreateAuthor Failed with message ". $e->getMessage();
}
$sessionID = $instance->createSession($groupID, $authorID, $timetoanswer);
echo "New Session ID is $sessionID->sessionID\n\n";
$agentsessionID = $sessionID->sessionID;

$message = "You just received a question\n
It has the subject: $questionSubject\n
It is sorted to the following categories: $categories\n
The Question is:\n\n$msg\n
15 Minutes to answer this question with the other agents will start in UTC $timedisplay\n 
Follow this link to answer the question: ".$GLOBALS["aphost"]."/answer/index.php?id=$questionIDfromDB&agentcode=$agentcode&authorID=$authorID\n\n
If you want to pause your account, follow this link: ".$GLOBALS["aphost"]."/agentstatus/change.php?email=".urlencode($agentaddress)."&pcode=$pcodesend&status=0\n
If at any time you want to reactivate your account: ".$GLOBALS["aphost"]."/agentstatus/change.php?email=".urlencode($agentaddress)."&pcode=$pcodesend&status=1";
// send mail
mail($agentaddress, $subject, $message, $headers);
$writePadDataAgents = "UPDATE answer_access SET $agentcode = '".$dbhandle->real_escape_string($authorID)."', ".$dbhandle->real_escape_string($agentcode)."sessionID = '".$dbhandle->real_escape_string($agentsessionID)."' WHERE questionID = '".$dbhandle->real_escape_string($_GET["id"])."'";
$dbhandle->query($writePadDataAgents);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
}
}
else {
echo "Already sent"; };
}
else {
echo "Not varified"; };
$dbhandle->close();
?>