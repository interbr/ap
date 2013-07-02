<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
require_once(__ROOT__.'/../php/answering-system.php'); //a file with etherpad-api-class
$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadhost"].'/api');
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionPreview = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$_GET["id"]."'");
$padAuthorAccess = $dbhandle->query("SELECT * FROM answer_access WHERE questionID='".$_GET["id"]."'");
while($row = $padAuthorAccess->fetch_assoc()) {
$groupID = $row['groupID'];
$padID = $row['padID'];
$authorIDGET = $_GET["agentcode"];
$authorID = $row["".$authorIDGET.""];
};
$dbhandle->close();
?>
		<script type="text/javascript">
			$(function(){
			$(document).ready(function() {
				$('#answerPad').pad({'padId':'<?php echo $padID; ?>', 'host':'<?php echo $GLOBALS["etherpadhost"]; ?>'}); // sets the pad id and puts the pad in the div
				$.ajax({
      			type: "POST",
      			url: "savedInitialAnswerToDatabaseWait.php?id=<?php echo $_GET["id"]; ?>",
				});
			});
			});
			function update() {	
			$.ajax({
				cache: false,
				type: 'GET',
				url: 'answerwhopper.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>&pad=<?php echo $padID; ?>',
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
		</script>
		<div class="textdiv" id="answerSystemDiv">
		<div id="answerPad"></div>
		</div>
		<div id="whopper">
		<div id="savedAnswerWait"></div>
		<div id="notice"></div>
		</div>
        