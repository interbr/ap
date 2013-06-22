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
$agentcodeForwarding = strip_tags($_GET["agentcode"]);
$authorIDForwarding = strip_tags($_GET["authorID"]);
$agentForwarding = $dbhandle->query("SELECT * FROM answer_access WHERE questionID='".$dbhandle->real_escape_string($_GET["id"])."' AND $agentcodeForwarding='".$dbhandle->real_escape_string($authorIDForwarding)."'");
if (mysqli_affected_rows($dbhandle) == 1) {
while($forwardingrow = $agentForwarding->fetch_assoc()) {
$forwardingSessionIDCol = $agentcodeForwarding."sessionID";
$forwardingSessionID = strip_tags($forwardingrow[$forwardingSessionIDCol]);
$forwardingGroupID = strip_tags($forwardingrow['groupID']);
$forwardingPadID = strip_tags($forwardingrow['padID']);
$forwardingTimeToAnswer = strip_tags($forwardingrow['timetoanswerSession']);
};

$agentsAlreadySent = $dbhandle->query("SELECT * FROM question_answer_agents WHERE questionID='".$dbhandle->real_escape_string($_GET["id"])."'");
while($agentsAlreadySentRow = $agentsAlreadySent->fetch_assoc()) {
$agentsAlreadySentResult = strip_tags($agentsAlreadySentRow['agents']);
};
$agentsAlreadySentArray = explode(",", $agentsAlreadySentResult);

$forwardedAgentAddressQuery = $dbhandle->query("SELECT * FROM agents WHERE (active='1') AND (NOT FIND_IN_SET(email, '$agentsAlreadySentResult')) ORDER BY RAND() LIMIT 0,1");
if (mysqli_affected_rows($dbhandle) == 1) {
while($forwardedrow = $forwardedAgentAddressQuery->fetch_assoc()) {
$forwardedAgentAddress = strip_tags($forwardedrow['email']);
$forwardedAgentPcode = strip_tags($forwardedrow['pcode']);
};

$writeQuestionAnswerAgents = "UPDATE question_answer_agents SET agents = IFNULL(CONCAT(agents, ',".$dbhandle->real_escape_string($forwardedAgentAddress)."'), '".$dbhandle->real_escape_string($forwardedAgentAddress)."') WHERE questionID = '".$dbhandle->real_escape_string($_GET["id"])."'";
$dbhandle->query($writeQuestionAnswerAgents);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";

$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadhost"].'/api');
$instance->deleteSession($forwardingSessionID);

try {
  $author = $instance->createAuthor($forwardedAgentAddress); // This really needs explaining..
  $forwardedAuthorID = $author->authorID;
  echo "The AuthorID is now $forwardedAuthorID\n\n";
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "\n\ncreateAuthor Failed with message ". $e->getMessage();
}

$sessionID = $instance->createSession($forwardingGroupID, $forwardedAuthorID, $forwardingTimeToAnswer);
echo "New Session ID is $sessionID->sessionID\n\n";
$forwardedAgentSessionID = $sessionID->sessionID;

$timetoanswer = $forwardingTimeToAnswer;
$timedisplay = date('c',$timetoanswer);
$timetomeet = strtotime('-60 minutes', $timetoanswer);
$timetomeetdisplay = gmdate('D, H:i:s',$timetomeet);

$subject = "Forwarded Test-Question: ".strip_tags($_GET["id"])." Subject: ".strip_tags($questionSubject);
$msg = strip_tags(file_get_contents($questionfile));

$writeForwardedAgentData = "UPDATE answer_access SET $agentcodeForwarding = '".$dbhandle->real_escape_string($forwardedAuthorID)."', $forwardingSessionIDCol = '".$dbhandle->real_escape_string($forwardedAgentSessionID)."' WHERE questionID = '".$dbhandle->real_escape_string($_GET["id"])."'";
$dbhandle->query($writeForwardedAgentData);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";



// mail settings
$headers = "From: no-reply@amored-police.org\r\n" .
	"Reply-To: no-reply@amored-police.org\r\n" .
    "Content-type:  text/plain; charset=utf-8\r\n" ;

$message = "You just received a forwarded question\n
It has the subject: $questionSubject\n
It is sorted to the following categories: $categories\n
The Question is:\n\n$msg\n
You and the other four agents who received this question will have 90 minutes to answer this question. Why not meet in 30 minutes (GMT $timetomeetdisplay)?\n
GMT (Greenwich mean time) is i.e. Berlin-time -2, Chicago-time +6, Hong-Kong-time -8 ...\n 
Follow this link to answer the question: ".$GLOBALS["aphost"]."/answer/index.php?id=$questionIDfromDB&agentcode=$agentcodeForwarding&authorID=$forwardedAuthorID\n
If you have no time to answer the question, too: ".$GLOBALS["aphost"]."/forward/forward.php?id=$questionIDfromDB&agentcode=$agentcodeForwarding&authorID=$forwardedAuthorID\n\n
If you want to pause your account, follow this link: ".$GLOBALS["aphost"]."/agentstatus/change.php?email=".urlencode($forwardedAgentAddress)."&pcode=$forwardedAgentPcode&status=0\n
If at any time you want to reactivate your account: ".$GLOBALS["aphost"]."/agentstatus/change.php?email=".urlencode($forwardedAgentAddress)."&pcode=$forwardedAgentPcode&status=1\n\n
If you want to delete your account: ".$GLOBALS["aphost"]."/agentstatus/deleteaccount.php?email=".urlencode($forwardedAgentAddress)."&pcode=$forwardedAgentPcode&delete=1\n\n
For questions regarding this question-answer-system or suggestions, please feel free to write to felix_longolius@amored-police.org\n";
// send mail
mail($forwardedAgentAddress, $subject, $message, $headers);
}
else {
echo "No agent found"; };
}
else {
echo "No question found"; };
}
else {
echo "Forwarding not possible"; };
$dbhandle->close();
?>