<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$subject = $_POST["subject"];
$categories =  strip_tags(implode(",",$_POST["questionCategories"]));
$questionid = $_POST["question-id"];
$questionemail = $_POST["questionaddress"];
$query = "INSERT INTO questions (subject, questionCategories, questionID, email) VALUES ('".$dbhandle->real_escape_string($subject)."', '".$dbhandle->real_escape_string($categories)."', '".$dbhandle->real_escape_string($questionid)."', '".$dbhandle->real_escape_string($questionemail)."') ON DUPLICATE KEY UPDATE subject=VALUES(subject), questionCategories=VALUES(questionCategories), email=VALUES(email)";
$dbhandle->query($query);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
$dbhandle->close();

echo var_export($_POST);
?>