<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionPreview = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$dbhandle->real_escape_string($_GET["id"])."'");
while($row = $questionPreview->fetch_assoc()) {
$questionfile = "../../content/".$row['questionID'].".txt"; //questionfile
$subject = $row['subject'];
$categories = $row['questionCategories'];
$questionIDfromDB = $row['questionID'];
$questionaddress = $row['email'];
$questionverified = $row['active'];
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
		</head>
		<body> 
		<span style="color: #fff; font-size: 18px; font-family: courier">Amored&nbsp;Police</span><br /><br />
        <div class="page">
<div id="savedQuestionPrepareToSend">
<div class="textdiv">Your question is saved on server. Don't forget to send it.</div>
<div class="textdiv"><i>Your question is saved with ID:</i> <?php echo strip_tags($_GET["id"]); ?></div>
<div class="textdiv"><i>It has the subject:</i><br /><?php echo strip_tags($subject) ?></div>
<div class="textdiv"><i>It has the Content:</i><br /><?php echo strip_tags(nl2br( file_get_contents($questionfile) ) ); ?></div>
<div class="textdiv"><i>It's sorted to the Categories:</i><br /><?php echo strip_tags($categories) ?></div>
<div class="textdiv"><i>The answer will be send to the following address:</i><br /><?php echo strip_tags($questionaddress) ?></div>
<div class="textdiv">Please be careful! Your question will be sent randomly to 5 email-addresses chosen from the agent-database of this website. The answer might be obscene, immature or most important: wrong! This website-system takes no influence on quality or content of answers.</div>
<div class="textdiv"><?php if ( $questionverified == '1' ) {
echo "<button id=\"clickSendQuestion\">Send Question</button>"; }
else {
echo "Not varified"; }; ?>
</div>
</div>
</div>
<script type="text/javascript">
$('#clickSendQuestion').click(function(){
 			$.ajax({
      			type: "POST",
      			url: "sendquestion.php?id=<?php echo $_GET["id"]; ?>",
				complete: function() {
		$('#savedQuestionPrepareToSend').load('questionsentresult.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		}
		});
		return false; 
		});
</script>
    </body>
</html>