<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
 $_GET['email'])) {
 $email = strip_tags($_GET['email']);
}
if (isset($_GET['id']) && (strlen($_GET['id']) == 12))
 {
 $questionID = strip_tags($_GET['id']);
}
if (isset($email) && isset($questionID)) {

 $query_publish_question = "SELECT * FROM questions WHERE(email ='".$dbhandle->real_escape_string($email)."' AND questionID='".$dbhandle->real_escape_string($questionID)."')LIMIT 1";
 $dbhandle->query($query_publish_question);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<head>
		<title><?php echo $GLOBALS["sitetitle"] ?></title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Platform for people to write to and get questions answered by other people.">
		<link rel="stylesheet" href="/css/styles.css">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		</head>
		<body>
		<span class="aptitle"><a href="/"><?php echo $GLOBALS["titleslogan"] ?></a></span><br /><br />
        	<div class="page">
		<div class="textdiv"><?php echo $GLOBALS["bodyslogan"] ?></div>
<?php		
 // Print a customized message:
 if (mysqli_affected_rows($dbhandle) == 1) //if update query was successfull
 {
 $query_publish_question2 = "UPDATE questions SET publish='1' WHERE(questionID ='".$dbhandle->real_escape_string($questionID)."')LIMIT 1";
 $dbhandle->query($query_publish_question2);
 echo '<div class="textdiv"><i>Your question is now allowed to be published.</i></div>';

 } else {
 echo '<div class="textdiv">Oops! Publishing could not be allowed for your question. Please recheck the link or contact the system administrator.</div>';

 }

 mysqli_close($dbhandle);

} else {
 echo '<div class="textdiv">Error Occured.</div>';
}
?>
</div>
		</body>
</html>
