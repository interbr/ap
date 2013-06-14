<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionid = $_GET["id"];
$query = "INSERT INTO answer_whopper (questionID) VALUES ('".$questionid."') ON DUPLICATE KEY UPDATE questionID=VALUES(questionID)";
$dbhandle->query($query);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
$dbhandle->close();

echo var_export($_POST);
?>