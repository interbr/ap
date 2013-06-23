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
$answersent = $questionrow['answer_sent'];
};
if ( $answersent != '1') {
require_once (__ROOT__.'/../php/class.phpmailer.php');
$writeSent = "UPDATE questions SET answer_sent = '1' WHERE questionID = '".$_GET["id"]."'";
$dbhandle->query($writeSent);
$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadhost"].'/api');
try {
  $padContents = $instance->getText($_GET["pad"]);
  $answer = $padContents->text;
} catch (Exception $e) {
  $answer = 'Error in answering system';
}

$subject = "Answer to Test-Question: ".$_GET["id"]." Subject: ".$questionSubject;
$msg = file_get_contents($questionfile);

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
$mail->AddAddress($question_address);
$mail->AddBCC('testing@t-cup.tv');
//Set the subject line
$mail->Subject = $subject;
$mail->IsHTML(false);
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->Body = 'You just received an answer

The question had the subject: '.$questionSubject.'
It was sorted to the following categories: '.$categories.'

The Question was:
'.$msg.'

The answer is:
'.$answer.'';

//Send the message, check for errors
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
}
else {
echo "Already sent"; };
$dbhandle->close();
?>