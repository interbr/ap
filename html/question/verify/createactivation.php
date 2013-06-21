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
$writeVerificSent = "UPDATE questions SET verific_sent = '1' WHERE questionID = '".$dbhandle->real_escape_string($_GET["id"])."'";
$dbhandle->query($writeVerificSent);
            // Create a unique  activation code:
            $activation = md5(uniqid(rand(), true));

            $query_insert_verify = "INSERT INTO question_verify ( questionID, email, activationkey) VALUES ( '".$dbhandle->real_escape_string($_GET["id"])."', '".$dbhandle->real_escape_string($emailToVerify)."' , '".$dbhandle->real_escape_string($activation)."')";
			$dbhandle->query($query_insert_verify);
			echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
			mysqli_close($dbhandle);
                // Send the email:
				$headers = "From: no-reply@amored-police.org\r\n" .
				"Reply-To: no-reply@amored-police.org\r\n" .
				"Content-type:  text/plain; charset=utf-8\r\n" ;
                $message = "To activate and send your question, please click on this link:\n\n";
                $message .= $GLOBALS["aphost"]."/question/verify/verify.php?email=" . urlencode($emailToVerify) . "&key=$activation&id=".$_GET["id"]."";
                mail($emailToVerify, 'Question Confirmation', $message, $headers);
}
else {
echo "Verification sent already";
mysqli_close($dbhandle);
};			
     
?>