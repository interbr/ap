<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
require_once(__ROOT__.'/../php/answering-system.php'); //a file with etherpad-api-class
$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadhost"].'/api');
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionPreview = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$_GET["id"]."'");
while($row = $questionPreview->fetch_assoc()) {
$questionfile = "../../content/".$row['questionID'].".txt"; //questionfile
$subject = $row['subject'];
$categories = $row['questionCategories'];
$questionIDfromDB = $row['questionID'];
};
$padAuthorAccess = $dbhandle->query("SELECT * FROM answer_access WHERE questionID='".$_GET["id"]."'");
while($row = $padAuthorAccess->fetch_assoc()) {
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
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<script type="text/javascript" src="/js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="/js/custom.js"></script>
		<script type="text/javascript" src="/js/etherpad-ap.js"></script>
		<script type="text/javascript">
			$(function(){
			$('#answerPad').pad({'padId':'<?php echo $padID; ?>', 'host':'<?php echo $GLOBALS["etherpadhost"]; ?>'}); // sets the pad id and puts the pad in the div
			$('#clickOpenAnswerSystem').click(function(){
			$('#openAnswerSystemButton').slideUp(1000);
			$('#answerSystemDiv').fadeIn(1000);
			$('#whopper').fadeIn(1000);
			$('#saveAnswerButton').fadeIn(1000);		
			$.ajax({
      			type: "POST",
      			url: "savedInitialAnswerToDatabaseWait.php?id=<?php echo $_GET["id"]; ?>",
				});
			function update() {	
			$.ajax({
				type: 'GET',
				url: 'answerwhopper.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>',
				timeout: 2000,
				success: function(data) {
				  $("#savedAnswerWait").html(data);
				  window.setTimeout(update, 4000);
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
				  $("#savedAnswerWait").html('<div class="textdiv">Timeout contacting server..</div>');
				  window.setTimeout(update, 8000);
				}
			});
			}
			$(document).ready(function() {
				update();
			});
				return false; });
			});
		</script>
		</head>
		<body> 
		<span style="color: #fff; font-size: 18px; font-family: courier">Amored&nbsp;Police</span><br /><br />
        <div class="page">
		<div id="answerdiv">
		<div class="textdiv" id="start">
	<!-- Debugging	<?php echo $padID; ?><br />
		<?php 
		echo "Session info:\n\n";
$sessioninfo = $instance->getSessionInfo($_COOKIE["sessionID"]);
var_dump($sessioninfo);
echo "\n"; ?><br /><br />
		<?php
		try {
  $padList = $instance->listPads($groupID); 
  echo "Available pads for this group:\n";
  var_dump($padList->padIDs);
  echo "\n";
} catch (Exception $e) {
  echo "\n\nlistPads Failed: ". $e->getMessage();
} ?><br /><br /> -->
Your question you were asked randomly has the ID: <?php echo $questionIDfromDB ?><br /><br />
It has the subject:<br /><br />
<?php echo $subject ?><br /><br />
It has the Content:<br /><br />
<?php echo nl2br( file_get_contents($questionfile) ); ?><br /><br />
<!--It's sorted to the Categories:<br /><br />
<?php echo $categories ?><br /><br /> -->
		<div class="textdiv" id="openAnswerSystemButton"><button id="clickOpenAnswerSystem">Open Answer-System</button></div>
		</div>
		<div class="textdiv" id="answerSystemDiv">
		<div id="answerPad"></div>
		</div>
		<div id="whopper">
		<div id="savedAnswerWait"></div>
		<div id="notice"></div>
		</div>
        </div>
		</div>
    </body>
</html>