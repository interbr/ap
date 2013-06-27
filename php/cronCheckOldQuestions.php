<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/configuration.php'); //a file with configurations
require_once (__ROOT__.'/class.phpmailer.php');

$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$timeold = strtotime("+5 minutes");
$checkOldQuestions = $dbhandle->query("SELECT * FROM answer_access WHERE old = '0' AND timetoanswerSession < $timeold");
$oldQuestionResult = array();
while ($oldQuestionRow = mysqli_fetch_array($checkOldQuestions)) {
    $oldQuestionResult[] = strip_tags($oldQuestionRow['questionID']);
}
if (mysqli_affected_rows($dbhandle) > 0) {
foreach($oldQuestionResult as $questionID) {
$checkOldQuestionExcuseQ = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$dbhandle->real_escape_string($questionID)."' AND excuse = '0' AND sent = '1' AND answer_sent = '0'");
while($excuserow = $checkOldQuestionExcuseQ->fetch_assoc()) {
$questionfile = "../content/".$excuserow['questionID'].".txt"; //questionfile
$questionEmail = strip_tags($excuserow['email']);
$questionSubject = strip_tags($excuserow['subject']);
};
if (mysqli_affected_rows($dbhandle) > 0) {

$subject = "Sorry, Test-Question not answered: ".strip_tags($questionID)." Subject: ".strip_tags($questionSubject);
$msg = strip_tags(file_get_contents($questionfile));

// send mail
$mail = new PHPMailer();
$mail->IsSendmail();
$mail->SetFrom('no-reply@amored-police.org', 'idea.amored-police.com question-answer-system');
$mail->AddReplyTo('no-reply@amored-police.org','idea.amored-police.com question-answer-system');
$mail->AddAddress($questionEmail);
$mail->AddBCC('felix@weltpolizei.de');
$mail->Subject = $subject;
$mail->IsHTML(false);
$mail->Body = 'Sorry, this is to inform you that your question with subject: '.$questionSubject.'
wasn\'t answered.

The Question was:
'.$msg.'

Five agents who received this question had 90 minutes to answer the question.

For questions regarding this question-answer-system or suggestions, please feel free to write to felix_longolius@amored-police.org

'.$GLOBALS["aphost"].'';

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Question excused!";
}
$setExcuseSent = "UPDATE questions SET excuse = '1' WHERE questionID = '".$dbhandle->real_escape_string($questionID)."'";
$dbhandle->query($setExcuseSent);
$setAgentsAvailable = "UPDATE agents SET busy = '0' WHERE busy = '1' AND last_questionID = '".$dbhandle->real_escape_string($questionID)."'";
$dbhandle->query($setAgentsAvailable);
$dbhandle->close();
echo $questionID; }
}
}
?>