<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$subject = mysqli_real_escape_string($dbhandle,$_POST["subject"]);
$categories =  implode(",",$_POST["questionCategories"]);
$questionid = $_POST["question-id"];
$questionemail = $_POST["questionaddress"];
$query = "INSERT INTO questions (subject, questionCategories, questionID, email) VALUES ('".$subject."', '".$categories."', '".$questionid."', '".$questionemail."') ON DUPLICATE KEY UPDATE subject=VALUES(subject), questionCategories=VALUES(questionCategories), email=VALUES(email)";
$dbhandle->query($query);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
$dbhandle->close();

echo var_export($_POST);
?>