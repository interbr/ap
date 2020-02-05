<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionToVerifyQuery = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$dbhandle->real_escape_string($_GET["id"])."'");
while($questionverifyrow = $questionToVerifyQuery->fetch_assoc()) {
$questionText = $questionverifyrow['questionText'];
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
			mysqli_close($dbhandle);

$subject = "Verify your email for Question: ".utf8_decode($questionSubjectToVerify);			
$msg = strip_tags($questionText);

			// send mail

//Create a new PHPMailer instance
$mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
$mail->IsSendmail();
//Set who the message is to be sent from
$mail->SetFrom('no-reply@amored-police.org',$GLOBALS["aphost"]);
//Set an alternative reply-to address
$mail->AddReplyTo('no-reply@amored-police.org',$GLOBALS["aphost"]);
//Set who the message is to be sent to
$mail->AddAddress($emailToVerify);
$mail->AddBCC('felix@weltpolizei.de');
//Set the subject line
$mail->Subject = $subject;
$mail->IsHTML(false);
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->Body = 'You or somebody else wants to ask a question via '.$GLOBALS["aphost"].' with this email-address.

To send the question to five randomly choosen agents now, please click on this link:
'.$GLOBALS["aphost"].'/question/verify/verify.php?email='.urlencode($emailToVerify).'&key='.$activation.'&id='.$_GET["id"].'

By the way, your question is:
'.utf8_decode($msg).'

For questions regarding this question-answer-system or suggestions, please feel free to write to '.$GLOBALS["siteemail"].'.';

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
