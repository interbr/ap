<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionToSend = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$_GET["id"]."'");
while($questionrow = $questionToSend->fetch_assoc()) {
$questionfile = "../../content/".$questionrow['questionID'].".txt"; //questionfile
$questionSubject = $questionrow['subject'];
$categories = $questionrow['questionCategories'];
$questionIDfromDB = $questionrow['questionID'];
$timeofsending = $questionrow['time-of-sending'];
};
$agentspool = $dbhandle->query("SELECT * FROM agents WHERE active='1' ORDER BY RAND() LIMIT 0,3");
$dbhandle->close();
$agentsresult = array();
$counter = 1;
while ($agentrow = mysqli_fetch_array($agentspool)) {
    $agentsresult["agent".$counter] =  $agentrow["email"];
    $counter = $counter + 1;
}
date_default_timezone_set("UTC");
$timetoanswer = date( "Y-m-d H:i:s", strtotime( "$timeofsending + 4 hours" ) );

extract($agentsresult);

$subject = "Test-Question: ".$_GET["id"]." Subject: ".$questionSubject;
$msg = file_get_contents($questionfile);
$receipients = array(
	'agent1' => $agent1,
    'agent2' => $agent2,
	'agent3' => $agent3);

// mail settings
$headers = "From: no-reply@amored-police.org\r\n" .
	"Reply-To: no-reply@amored-police.org\r\n" .
    "Content-type:  text/plain; charset=utf-8\r\n" ;
foreach ($receipients as $agentcode => $agentaddress) {
$message = "You just received a question\n
It has the subject: $questionSubject\n
It is sorted to the following categories: $categories\n
The Question is:\n\n$msg\n
15 Minutes to answer this question with the other agents will start in UTC $timetoanswer\n 
Follow this link to answer the question: ".$GLOBALS["aphost"]."/answer/answer.php?id=$questionIDfromDB&agentcode=$agentcode\n
Follow this link to answer the question: ".$GLOBALS["aphost"]."/answer/answer.php?id=$questionIDfromDB\n
Follow this link to answer the question: ".$GLOBALS["aphost"]."/answer/answer.php?id=$questionIDfromDB\n
Follow this link to answer the question: ".$GLOBALS["aphost"]."/answer/answer.php?id=$questionIDfromDB";
// send mail
mail($agentaddress, $subject, $message, $headers);
}
echo $agent1."<br />";
echo $agent2."<br />";
echo $agent3."<br />";
?>