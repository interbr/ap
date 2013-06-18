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

 $query_activate_question = "UPDATE question_verify SET activationkey=NULL WHERE(email ='$email' AND activationkey='$key')LIMIT 1";
 $dbhandle->query($query_activate_question);

 // Print a customized message:
 if (mysqli_affected_rows($dbhandle) == 1) //if update query was successfull
 {
 $query_activate_question2 = "UPDATE questions SET active='1' WHERE(questionID ='$questionID')LIMIT 1";
 $dbhandle->query($query_activate_question2);
 echo '<div>Your account is now active. You may now <a href="/question/verifiedquestion.php?id='.$questionID.'">Log in</a></div>';

 } else {
 echo '<div>'.$email.' and '.$key.' Oops !Your account could not be activated. Please recheck the link or contact the system administrator.</div>';

 }

 mysqli_close($dbhandle);

} else {
 echo '<div>Error Occured .</div>';
}
?>