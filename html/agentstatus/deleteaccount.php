<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
 $_GET['email'])) {
 $email = strip_tags($_GET['email']);
}
if (isset($_GET['pcode']) && (strlen($_GET['pcode']) == 32))
 {
 $pcode = strip_tags($_GET['pcode']);
}
if (isset($_GET['delete']) && (strlen($_GET['delete']) == 1))
 {
 $deletewanted = strip_tags($_GET['delete']);
}

if (isset($email) && isset($pcode) && isset($deletewanted)) {

 $query_delete_agent_status = "SELECT * FROM agents WHERE(email ='".$dbhandle->real_escape_string($email)."' AND pcode='".$dbhandle->real_escape_string($pcode)."')LIMIT 1";
 $dbhandle->query($query_delete_agent_status);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<head>
		<title>Help Desk for Earth' Peoples Problems (except IT) - github-project - amored-police</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Platform for people to write to and get questions answered by other people.">
		<link rel="stylesheet" href="/css/styles.css">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<script type="text/javascript" src="/js/jquery-1.10.1.min.js"></script>
		</head>
		<body>
		<span class="aptitle"><a href="/">Amored&nbsp;Police</a></span><br /><br />
        <div class="page">
<div class="textdiv">Help-Desk for Earth' Peoples Problems (except IT)</div>
<div class="textdiv"><?php
 if (mysqli_affected_rows($dbhandle) == 1) {
 echo "Do you really want to delete your account? If so please click:<br /><br /><button id=\"clickDeleteAccount\">Delete Account</button><br /><br />
 You may also pause your account, only. To do this click the following:<br /><br /><a href=\"/agentstatus/change.php?email=".urlencode($email)."&pcode=$pcode&status=0\"><button>Pause your account</button></a>";
 } else {
 echo 'Oops! Your account could not be found. Please recheck the link or contact the system administrator.';

 }
} else {
 echo '<div>Error Occured.</div>';
}
mysqli_close($dbhandle);
?>
</div>
</div>
<script type="text/javascript">
$('#clickDeleteAccount').click(function(){
 			$.ajax({
      			type: "POST",
      			url: "deleteAccountFromDatabase.php?email=<?php echo urlencode($email); ?>&pcode=<?php echo $pcode; ?>&delete=1",
				complete: function() {
		location.reload();
		}
		});
		return false; 
		});
</script>
		</body>
</html>