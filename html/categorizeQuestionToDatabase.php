<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/php/configuration.php'); //a file with configurations
$dbhandle = mysql_connect('localhost', 'ap-db-client', $GLOBALS["dbpw"]);
mysql_select_db('amored-police');
$subject = $_POST["subject"];
$categories =  implode(",",$_POST["questionCategories"]);
$questionid = $_POST["question-id"];
$query = "INSERT INTO questions (subject, questionCategories, questionID) VALUES ('".$subject."', '".$categories."', '".$questionid."') ON DUPLICATE KEY UPDATE subject=VALUES(subject), questionCategories=VALUES(questionCategories)";
mysql_query($query);
echo mysql_errno($dbhandle) . ": " . mysql_error($dbhandle) . "\n";
mysql_close($dbhandle);

echo var_export($_POST);
?>