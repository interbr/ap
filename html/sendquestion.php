<?php
$questionFile = $_GET["id"];
$questionFilePath = "../content/".$questionfile.".txt";

$name = trim($_POST['name']); //not used
$email = trim($_POST['email']); //not used
$subject = "Test-Question " . $_GET["id"]."!";
$msg = "abc"; //trim(nl2br( file_get_contents($GLOBALS["questionFilePath"]) ) );

//mail settings
$apperson_address = "testing@amored-police.org";
$headers = "From: amored-police-Testing\r\n" .
    "Content-type:  text/plain; charset=utf-8";
$message = "Question is:\n\n $msg";
//send mail
mail($apperson_address, $subject, $message, $headers);
?>