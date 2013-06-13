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
};
$dbhandle->close();
?>
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
<button id="clickSendQuestion">Send Question</button>
</div>
<script type="text/javascript">
$('#clickSendQuestion').click(function(){
 			$.ajax({
      			type: "POST",
      			url: "sendquestion.php?id=<?php echo $_GET["id"]; ?>",
				});
		$('#questionSentResult').load('questionsentresult.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		$('#savedQuestionPrepareToSend').slideUp(1000);
		return false; 
		});
</script>