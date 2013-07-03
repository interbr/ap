<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
require_once (__ROOT__.'/../php/class.phpmailer.php');
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$agentcontinent = strip_tags($_POST["agentContinent"]);
$wantedCategories = strip_tags($_POST["agentWantedCategories"]);
$unwantedCategories = strip_tags($_POST["agentUnwantedCategories"]);
$agentemail = strip_tags($_POST["agentaddress"]);
$agenttzone = strip_tags($_POST["agenttimezone"]);
$originalmail = strip_tags($_POST["originalmail"]);
$pcode = strip_tags($_POST["pcode"]);
if (isset($_POST['agenttime'])) {
$agenttime = strip_tags(implode(",",$_POST["agenttime"]));
}
else {
$agenttime = 'never'; };
$query = "UPDATE agents SET continent='".$dbhandle->real_escape_string($agentcontinent)."', wanted='".$dbhandle->real_escape_string($wantedCategories)."', unwanted='".$dbhandle->real_escape_string($unwantedCategories)."', email='".$dbhandle->real_escape_string($agentemail)."', agenttzone='".$dbhandle->real_escape_string($agenttzone)."', agenttime='".$dbhandle->real_escape_string($agenttime)."' WHERE email='".$dbhandle->real_escape_string($originalmail)."' AND pcode='".$dbhandle->real_escape_string($pcode)."'";
$dbhandle->query($query);
if (mysqli_affected_rows($dbhandle) == 1) {
//Create a new PHPMailer instance
$mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
$mail->IsSendmail();
//Set who the message is to be sent from
$mail->SetFrom('no-reply@amored-police.org', 'idea.amored-police.com question-answer-system');
//Set an alternative reply-to address
$mail->AddReplyTo('no-reply@amored-police.org','idea.amored-police.com question-answer-system');
//Set who the message is to be sent to
$mail->AddAddress($agentemail);
$mail->AddBCC('felix@weltpolizei.de');
//Set the subject line
$mail->Subject = 'Confirmation for refresh of data';
$mail->IsHTML(false);
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->Body = 'Thank you for refreshing your data at '.$GLOBALS["aphost"].'!

Change your data again: 
'.$GLOBALS["aphost"].'/agentstatus/settings.php?email='.urlencode($agentemail).'&pcode='.$pcode.'&settings=1

At anytime you may pause or delete your account with the following link:
'.$GLOBALS["aphost"].'/agentstatus/deleteaccount.php?email='.urlencode($agentemail).'&pcode='.$pcode.'&delete=1

Activate your account again at any time with the following link:
'.$GLOBALS["aphost"].'/agentstatus/changeactive.php?email='.urlencode($agentemail).'&pcode='.$pcode.'&status=1

For questions regarding this question-answer-system or suggestions, please feel free to write to felix_longolius@amored-police.org';

if(!$mail->Send()) {
  echo "Ooops, we think there was an error!";
} else {
  echo "<div class=\"textdiv\">Thank you! Data saved. You were sent a confirmation email.</div>";
}
}
else {
echo "<div class=\"textdiv\">Sorry, there was an error. Please retry or contact the system administrator. (Did you change anything?)</div>"; };
$dbhandle->close();
?>