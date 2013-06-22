<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
 $_GET['email'])) {
 $email = strip_tags($_GET['email']);
}
if (isset($_GET['pcode']) && (strlen($_GET['pcode']) == 32))
 //The Activation key will always be 32 since it is MD5 Hash
 {
 $pcode = strip_tags($_GET['pcode']);
}
if (isset($_GET['status']) && (strlen($_GET['status']) == 1))
 {
 $activestatuswanted = strip_tags($_GET['status']);
}

if (isset($email) && isset($pcode) && isset($activestatuswanted)) {

 $query_change_agent_status = "SELECT * FROM agents WHERE(email ='".$dbhandle->real_escape_string($email)."' AND pcode='".$dbhandle->real_escape_string($pcode)."')LIMIT 1";
 $dbhandle->query($query_change_agent_status);
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
 if (mysqli_affected_rows($dbhandle) == 1)
 {
	$query_active = $dbhandle->query("SELECT active FROM agents WHERE(email ='".$dbhandle->real_escape_string($email)."' AND pcode='".$dbhandle->real_escape_string($pcode)."')LIMIT 1");
    while($active_row = $query_active->fetch_assoc()) {
	$activestatus = $active_row['active'];
	};
	
 if ( $activestatuswanted == $activestatus ) {
 echo "You are already "; if ($activestatuswanted == '1') { echo "active"; } else { echo "paused"; }; }
 else {
 $query_change_agent_status2 = "UPDATE agents SET active='".$dbhandle->real_escape_string($activestatuswanted)."' WHERE(email ='".$dbhandle->real_escape_string($email)."' AND pcode='".$dbhandle->real_escape_string($pcode)."')LIMIT 1";
 $dbhandle->query($query_change_agent_status2);
 echo "You are now "; if ($activestatuswanted == '1') { echo "active"; } else { echo "paused"; };
 };

 } else {
 echo 'Oops! Your status could not be changed. Please recheck the link or contact the system administrator.';

 }
} else {
 echo '<div>Error Occured.</div>';
}
mysqli_close($dbhandle);
?>
</div>
</div>
		</body>
</html>