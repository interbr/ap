<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionToVerifyQuery = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$dbhandle->real_escape_string($_GET["id"])."'");
while($questionverifyrow = $questionToVerifyQuery->fetch_assoc()) {
$questionToVerify = "../../../content/".$questionverifyrow['questionID'].".txt"; //questionfile
$emailToVerify = $questionverifyrow['email'];
$questionSubjectToVerify = $questionverifyrow['subject'];
$verificationsent = $questionverifyrow['verific_sent'];
};
if ( $verificationsent != '1') {
require_once (__ROOT__.'/../../php/class.phpmailer.php');
$writeVerificSent = "UPDATE questions SET verific_sent = '1' WHERE questionID = '".$dbhandle->real_escape_string($_GET["id"])."'";
$dbhandle->query($writeVerificSent);
            // Create a unique  activation code:
            $activation = md5(uniqid(rand(), true));

            $query_insert_verify = "INSERT INTO question_verify ( questionID, email, activationkey) VALUES ( '".$dbhandle->real_escape_string($_GET["id"])."', '".$dbhandle->real_escape_string($emailToVerify)."' , '".$dbhandle->real_escape_string($activation)."')";
			$dbhandle->query($query_insert_verify);
			echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
			mysqli_close($dbhandle);
			
			// send mail

//Create a new PHPMailer instance
$mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
$mail->IsSendmail();
//Set who the message is to be sent from
$mail->SetFrom('no-reply@amored-police.org', 'Amored Police question-answer-system');
//Set an alternative reply-to address
$mail->AddReplyTo('no-reply@amored-police.org','Amored Police question-answer-system');
//Set who the message is to be sent to
$mail->AddAddress($emailToVerify);
//Set the subject line
$mail->Subject = 'Question Confirmation';
$mail->IsHTML(false);
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->Body = 'To activate and send your question, please click on this link:

'.$GLOBALS["aphost"].'/question/verify/verify.php?email='.urlencode($emailToVerify).'&key='.$activation.'&id='.$_GET["id"].'';

//Send the message, check for errors
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
}
else {
echo "Verification sent already";
mysqli_close($dbhandle);
};			
     
?>