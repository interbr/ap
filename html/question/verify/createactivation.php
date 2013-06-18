<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionToVerifyQuery = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$_GET["id"]."'");
while($questionverifyrow = $questionToVerifyQuery->fetch_assoc()) {
$questionToVerify = "../../../content/".$questionverifyrow['questionID'].".txt"; //questionfile
$emailToVerify = $questionverifyrow['email'];
$questionSubjectToVerify = $questionverifyrow['subject'];
};

            // Create a unique  activation code:
            $activation = md5(uniqid(rand(), true));

            $query_insert_verify = "INSERT INTO question_verify ( questionID, email, activationkey) VALUES ( '".$_GET["id"]."', '$emailToVerify' , '$activation')";
			$dbhandle->query($query_insert_verify);
			echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
			mysqli_close($dbhandle);
                // Send the email:
				$headers = "From: no-reply@amored-police.org\r\n" .
				"Reply-To: no-reply@amored-police.org\r\n" .
				"Content-type:  text/plain; charset=utf-8\r\n" ;
                $message = "To activate and send your question, please click on this link:\n\n";
                $message .= $GLOBALS["aphost"].'/question/verify/verify.php?email=' . urlencode($emailToVerify) . "&key=$activation&id=".$_GET["id"]."";
                mail($emailToVerify, 'Question Confirmation', $message, $headers);
			
     
?>