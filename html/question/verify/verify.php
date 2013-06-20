<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
 $_GET['email'])) {
 $email = $_GET['email'];
}
if (isset($_GET['key']) && (strlen($_GET['key']) == 32))
 //The Activation key will always be 32 since it is MD5 Hash
 {
 $key = $_GET['key'];
}
$questionID = $_GET['id'];
if (isset($email) && isset($key)) {

 // Update the database to set the "activation" field to null

 $query_activate_question = "SELECT * FROM question_verify WHERE(email ='$email' AND activationkey='$key')LIMIT 1";
 $dbhandle->query($query_activate_question);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<head>
		<title>Help Desk for Earth' Peoples Problems (except IT) - github-project - amored-police</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Platform for people to write to and get questions answered by other people.">
		<link rel="stylesheet" href="/css/styles.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		</head>
		<body>
		<span style="color: #fff; font-size: 18px; font-family: courier">Amored&nbsp;Police</span><br /><br />
        <div class="page">
<div class="textdiv">Help-Desk for Earth' Peoples Problems (except IT)</div>
<div class="textdiv"><?php
		
 // Print a customized message:
 if (mysqli_affected_rows($dbhandle) == 1) //if update query was successfull
 {
 $query_activate_question2 = "UPDATE questions SET active='1' WHERE(questionID ='$questionID')LIMIT 1";
 $dbhandle->query($query_activate_question2);
 echo 'Your question is now active. You may now <br /><br /><a href="/question/verifiedquestion.php?id='.$questionID.'"><button>Send your question</button></a><br /><br />on the next page ..</div>';

 } else {
 echo 'Oops! Your question could not be activated. Please recheck the link or contact the system administrator.';

 }

 mysqli_close($dbhandle);

} else {
 echo '<div>Error Occured.</div>';
}
?>
</div>
</div>
		</body>
</html>