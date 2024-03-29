<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionPublishQuery = "SELECT * FROM questions WHERE publish='1' ORDER BY id DESC LIMIT 20";
$resultQuestion = $dbhandle->query($questionPublishQuery);
$dbhandle->close();
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
<div class="textdiv">Last answered questions that were allowed to be published ..</div>
<?php while($publishQuestionRow = $resultQuestion->fetch_assoc()) { ?>
<div class="textdiv"><b>Question:</b> <?php echo $publishQuestionRow["subject"]; ?><br /><br />
<div style="text-align: left"><?php $questionText = $publishQuestionRow['questionText']; echo strip_tags($questionText, '<p><br>'); ?></div><br /><br />
<b>Answer:</b><br /><br /><div style="text-align: left"><?php echo $publishQuestionRow["answerText"]; ?></div>
</div>
<?php 
};
?> 
<div class="textdiv"><a href="/">Start</a> | <a href="/about.php">About</a> | <a href="mailto:<?php echo $GLOBALS["siteemail"] ?>">Contact</a></div>
		</div>
		</body>
</html>
