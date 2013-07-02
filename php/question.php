<?php
require_once('configuration.php'); 
if (empty($idNum)) {
$length = 12;
$randomString = substr(str_shuffle("123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ"), 0, $length);
$idNum = $randomString; //generate 12-digit-random-ID that will be assigned to question
}

function questionOpen () { 
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
session_start();
$questionID = $_SESSION['questionID'];
$openQuestionQuery = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$dbhandle->real_escape_string($questionID)."'");
while($openSaveRow = $openQuestionQuery->fetch_assoc()) {
if (mysqli_affected_rows($dbhandle) == 1) {
	echo $openSaveRow["questionText"];
}
else {
	$openSaveQuestionQuery = "INSERT INTO questions (questionID, questionText) VALUES ('".$dbhandle->real_escape_string($questionID)."', 'This is my question: ')";
	$dbhandle->query($openSaveQuestionQuery);
	$openQuestionQuery = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$dbhandle->real_escape_string($questionID)."'");
	while($openSaveRow = $openQuestionQuery->fetch_assoc()) {
	echo $openSaveRow["questionText"];	
	echo mysqli_error($dbhandle);
}
}
}
$dbhandle->close();
}

?>