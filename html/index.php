<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$activeAgentsCount = $dbhandle->query("SELECT * FROM agents WHERE active='1'");
$activeNumber = $activeAgentsCount->num_rows;
$dbhandle->close();
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
		<span class="aptitle"><a href="/">Amored&nbsp;Police</a></span><br /><br />
        <div class="page">
<div class="textdiv">Help-Desk for Earth' Peoples Problems (except IT)</div>
<div class="textdiv">What do you want?</div>
<div class="textdiv">Here you can:</div>
<div class="textdiv"><a href="/question"><button>Ask a question</button></a></div>
<div class="textdiv">or</div>
<div class="textdiv"><a href="/signup"><button>Sign up to be an Agent</button></div></a>
<div class="textdiv">There are currently</div>
<div class="textdiv"><?php echo $activeNumber; ?></div>
<div class="textdiv">active help-desk-agents on this website!</div>
<div class="textdiv"><a href="/about.php">About</a> | <a href="mailto:felix_longolius@amored-police.org">Contact</a></div>
		</div>
		</body>
</html>