<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$subject = $_POST["subject"];
$categories =  implode(",",$_POST["questionCategories"]);
$questionid = $_POST["question-id"];
$query = "INSERT INTO questions (subject, questionCategories, questionID) VALUES ('".$subject."', '".$categories."', '".$questionid."') ON DUPLICATE KEY UPDATE subject=VALUES(subject), questionCategories=VALUES(questionCategories)";
$dbhandle->query($query);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
$dbhandle->close();

echo var_export($_POST);
?>