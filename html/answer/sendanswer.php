<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
require_once(__ROOT__.'/../php/answering-system.php'); //a file with etherpad-api-class
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionToSend = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$_GET["id"]."'");
while($questionrow = $questionToSend->fetch_assoc()) {
$questionfile = "../../content/".$questionrow['questionID'].".txt"; //questionfile
$questionSubject = $questionrow['subject'];
$categories = $questionrow['questionCategories'];
$questionIDfromDB = $questionrow['questionID'];
$question_address = $questionrow['email'];
};
$dbhandle->close();
$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadhost"].'/api');
try {
  $padContents = $instance->getText($_GET["pad"]);
  $answer = $padContents->text;
} catch (Exception $e) {
  $answer = 'Error in answering system';
}

$subject = "Answer to Test-Question: ".$_GET["id"]." Subject: ".$questionSubject;
$msg = file_get_contents($questionfile);

// mail settings
$headers = "From: no-reply@amored-police.org\r\n" .
	"Reply-To: no-reply@amored-police.org\r\n" .
    "Content-type:  text/plain; charset=utf-8";
$message = "You just received an answer\n
The question had the subject: $questionSubject\n
It was sorted to the following categories: $categories\n
The Question was:\n\n$msg\n
The answer is:\n\n$answer";
// send mail
mail($question_address, $subject, $message, $headers);
?>