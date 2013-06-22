<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$answerAccess = $dbhandle->query("SELECT * FROM answer_access WHERE questionID='".$_GET["id"]."'");
while($row = $answerAccess->fetch_assoc()) {
$groupID = $row['groupID'];
$padID = $row['padID'];
$authorIDGET = $_GET["agentcode"];
$authorID = $row["".$authorIDGET.""];
};
$dbhandle->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<head>
		<title>Help Desk for Earth' Peoples Problems (except IT) - github-project - amored-police</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Platform for people to write to and get questions answered by other people.">
		<link rel="stylesheet" href="/css/styles.css">
		<link rel="stylesheet" href="/css/mediaelementplayer.min.css" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<script type="text/javascript" src="/js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="/js/custom.js"></script>
		<script type="text/javascript" src="/js/etherpad-ap.js"></script>
		<script type="text/javascript" src="/js/mediaelement-and-player.min.js"></script>
		<script type="text/javascript">
			function update() {	
			$.ajax({
				cache: false,
				type: 'GET',
				url: 'agentOnline.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>&authorID=<?php echo $_GET["authorID"]; ?>&groupID=<?php echo $groupID; ?>',
				timeout: 2000,
				success: function(data) {
				  $("#online_status").html(data);
				  window.setTimeout(update, 4000);
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
				  $("#online_status").html('Timeout contacting server..');
				  window.setTimeout(update, 8000);
				}
			});
			}
			$(document).ready(function() {
				update();
			});
		</script>
		</head>
		<body> 
		<span style="color: #fff; font-size: 18px; font-family: courier">Amored&nbsp;Police</span><br /><br />
        <div class="page">
		<div class="textdiv">Help-Desk for Earth' Peoples Problems (except IT)</div>
		<div id="answerdiv"><div class="textdiv" id="online_status"></div></div>
        </div>
		<div style="visibility: hidden;"><audio id="startbell" src="/js/sebell.mp3"></audio></div>
		<script type="text/javascript">
		var player = new MediaElementPlayer('#startbell', { startVolume: 0.2 } );
		</script>
    </body>
</html>