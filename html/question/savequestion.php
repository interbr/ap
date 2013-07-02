<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$content = strip_tags(nl2br($_POST['question']), '<p><br>');

$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
session_start();
$questionID = $_SESSION['questionID'];
$openSaveQuestionQuery = "INSERT INTO questions (questionID, questionText) VALUES ('".$dbhandle->real_escape_string($questionID)."', '".$dbhandle->real_escape_string($content)."') ON DUPLICATE KEY UPDATE questionText=VALUES(questionText)";
$dbhandle->query($openSaveQuestionQuery);
$dbhandle->close();

?> 