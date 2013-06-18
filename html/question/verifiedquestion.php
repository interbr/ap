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
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="/js/custom.js"></script>
		</head>
		<body> 
		<span style="color: #fff; font-size: 18px; font-family: courier">Amored&nbsp;Police</span><br /><br />
        <div class="page">
<div class="textdiv" id="savedQuestionPrepareToSend">
Your question is saved on server. Don't forget to send it.<br /><br />
Your question is saved with ID: <?php echo $_GET["id"]; ?><br /><br />
It has the subject:<br /><br />
<?php echo $subject ?><br /><br />
It has the Content:<br /><br />
<?php echo nl2br( file_get_contents($questionfile) ); ?><br /><br />
It's sorted to the Categories:<br /><br />
<?php echo $categories ?><br /><br />
It will be send with the following ID:<br /><br />
<?php echo $questionIDfromDB ?><br /><br />
The answer will be send to the following address:<br /><br />
<?php echo $questionaddress ?><br /><br />
<?php if ( $questionverified == '1' ) {
echo "<button id=\"clickSendQuestion\">Send Question</button>"; }
else {
echo "Not varified"; }; ?>
</div>
</div>
<script type="text/javascript">
$('#clickSendQuestion').click(function(){
 			$.ajax({
      			type: "POST",
      			url: "sendquestion.php?id=<?php echo $_GET["id"]; ?>",
				});
		$('#savedQuestionPrepareToSend').load('questionsentresult.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		return false; 
		});
</script>
    </body>
</html>