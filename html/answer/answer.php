<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionPreview = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$_GET["id"]."'");
while($row = $questionPreview->fetch_assoc()) {
$questionfile = "../../content/".$row['questionID'].".txt"; //questionfile
$subject = $row['subject'];
$categories = $row['questionCategories'];
$questionIDfromDB = $row['questionID'];
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
		<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
		<script type="text/javascript" src="/js/custom.js"></script>
		<script type="text/javascript" src="/js/etherpad-ap.js"></script>
		<script type="text/javascript">
			$(function(){
			$('#answerPad').pad({'padId':'<?php echo $_GET["id"]; ?>', 'host':'<?php echo $GLOBALS["etherpadhost"]; ?>'}); // sets the pad id and puts the pad in the div
			$('#clickOpenAnswerSystem').click(function(){
			$('#openAnswerSystemButton').slideUp(1000);
			$('#answerSystemDiv').fadeIn(1000);
			$('#saveAnswerButton').fadeIn(1000);
				return false; });
			$('#clickSaveAnswerPrepareToSend').click(function(){
			$('#answerSystemDiv').slideUp(1000);
			$('#saveAnswerButton').slideUp(1000);
			$('#savedAnswerPreview').load('savedanswerpreview.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
				return false; });
				});
		</script>
		</head>
		<body> 
		<span style="color: #fff; font-size: 18px; font-family: courier">Amored&nbsp;Police</span><br /><br />
        <div class="page">
		<div class="textdiv" id="start">
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
		<div class="textdiv" id="saveAnswerButton"><button id="clickSaveAnswerPrepareToSend">Save and prepare to send</button><br /></div>
		<div id="savedAnswerPreview"></div>
        </div>
    </body>
</html>