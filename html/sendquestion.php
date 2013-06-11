<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionToSend = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$_GET["id"]."'");
while($questionrow = $questionToSend->fetch_assoc()) {
$questionfile = "../content/".$questionrow['questionID'].".txt"; //questionfile
$questionSubject = $questionrow['subject'];
$categories = $questionrow['questionCategories'];
$questionIDfromDB = $questionrow['questionID'];
};
$agents = $dbhandle->query("SELECT * FROM agents ORDER BY RAND() LIMIT 0,1");
while ($agentrow = $agents->fetch_assoc()) {
$agent1 = $agentrow["email"];
}
$dbhandle->close();

$subject = "Test-Question: ".$_GET["id"]." Subject: ".$questionSubject;
$msg = file_get_contents($questionfile);

// mail settings
$agent_address = $agent1;
$headers = "From: no-reply@amored-police.org\r\n" .
	"Reply-To: no-reply@amored-police.org\r\n" .
    "Content-type:  text/plain; charset=utf-8";
$message = "You just received a question\n
It has the subject: $questionSubject\n
It is files in the following categories: $categories\n
The Question is:\n\n$msg";
// send mail
mail($agent_address, $subject, $message, $headers);
?>