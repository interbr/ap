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
};
$dbhandle->close();
?>
<div id="savedQuestionPrepareToVerify">
<div class="textdiv">Your question is saved on server. Don't forget to send it.</div>
<div class="textdiv"><i>Your question is saved with ID:</i><br /><?php echo strip_tags($_GET["id"]); ?></div>
<div class="textdiv"><i>It has the subject:</i><br /><?php echo strip_tags($subject) ?></div>
<div class="textdiv"><i>It has the Content:</i><br /><?php echo strip_tags(nl2br( file_get_contents($questionfile) ) ); ?></div>
<div class="textdiv"><i>It's sorted to the Categories:</i><br /><?php echo strip_tags($categories) ?></div>
<div class="textdiv"><i>The answer will be send to the following address:</i><br /><?php echo strip_tags($questionaddress) ?></div>
<div class="textdiv"><button id="clickSendQuestion">Verify Question</button></div>
</div>
<script type="text/javascript">
$('#clickSendQuestion').click(function(){
 			$.ajax({
      			type: "POST",
      			url: "verify/createactivation.php?id=<?php echo $_GET["id"]; ?>",
				complete: function () {
		$('#createActivationResult').load('verify/createactivationresult.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		$('#savedQuestionPrepareToVerify').slideUp(1000);
		}
		});
		return false; 
		});
</script>