<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionid = $_GET["id"];
$agentcode =  $_GET["agentcode"];
$query = "INSERT INTO answer_start_system (questionID, $agentcode) VALUES ('".$questionid."', '1') ON DUPLICATE KEY UPDATE $agentcode=VALUES($agentcode)";
$dbhandle->query($query);
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
$dbhandle->close();

echo var_export($_POST);
?>