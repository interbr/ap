<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
require_once(__ROOT__.'/../php/answering-system.php'); //a file with etherpad-api-class
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionToSend = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$_GET["id"]."'");
while($questionrow = $questionToSend->fetch_assoc()) {
$questionText = $questionrow['questionText'];
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
$setAgentsAvailable = "UPDATE agents SET busy = '0' WHERE busy = '1' AND last_questionID = '".$dbhandle->real_escape_string($questionIDfromDB)."'";
$dbhandle->query($setAgentsAvailable);
$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadapihost"].'/api');
try {
  $padContents = $instance->getHTML($_GET["pad"]);
  $answer = strip_tags($padContents->html, '<p><br>');
} catch (Exception $e) {
  $answer = 'Error in answering system';
}

$writeAnswerToDatabase = "UPDATE questions SET answerText = '".$dbhandle->real_escape_string($answer)."' WHERE questionID = '".$dbhandle->real_escape_string($questionIDfromDB)."'";
$dbhandle->query($writeAnswerToDatabase);

$subject = "Answer to Question: ".$questionSubject;
$msg = strip_tags($questionText);

// send mail

//Create a new PHPMailer instance
$mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
$mail->IsSendmail();
//Set who the message is to be sent from
$mail->SetFrom('no-reply@amored-police.com',$GLOBALS["aphost"]);
//Set an alternative reply-to address
$mail->AddReplyTo('no-reply@amored-police.com',$GLOBALS["aphost"]);
//Set who the message is to be sent to
$mail->AddAddress($question_address);
if ( $GLOBALS["sentInBCC"] == '1' )
  $mail->AddBCC($GLOBALS["sentInBCCAddress"]);
//Set the subject line
$mail->Subject = $subject;
$mail->IsHTML(false);
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->Body = 'You just received an answer

The question had the subject: '.utf8_decode($questionSubject).'
It was sorted to the following categories: '.$categories.'

The Question was:
'.utf8_decode($msg).'

The answer is:
'.html_entity_decode(htmlspecialchars_decode(preg_replace('#<br\s*?/?>#i', "\n", $answer)), ENT_QUOTES, 'cp1252').'

If you want to allow to publish the question and answer, please click the following link:
'.$GLOBALS["aphost"].'/publish/publish.php?email='.urlencode($question_address).'&id='.$questionIDfromDB.'

For questions regarding this question-answer-system or suggestions, please feel free to write to '.$GLOBALS["siteemail"].'.';

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
