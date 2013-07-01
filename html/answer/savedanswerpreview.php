<?php 
$fy = "../../content/".$_GET["id"].".txt"; //questionfile
?>
<div class="textdiv">
Question was:<br /><br />
<?php echo nl2br( file_get_contents($GLOBALS["fy"]) ); ?>
</div>
<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/answering-system.php'); //a file with etherpad-api-class
require_once(__ROOT__.'/../php/configuration.php');
$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadapihost"].'/api');
try {
  $padContents = $instance->getHTML($_GET["pad"]);
  $answerPreview = strip_tags($padContents->html, '<p><br>');
  echo "<div class=\"textdiv\">The Answer is as follows:<br /><br />$answerPreview</div>";
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "<div class=\"textdiv\">Etherpad-Error (getText Failed)</div>";
}
?>
<div class="textdiv" id="sendAnswer"></div>
<div id="answerSentResult"></div>
<script type="text/javascript">
		function update() {	
			$.ajax({
				cache: false,
				type: 'GET',
				url: 'answerSent.php?id=<?php echo $_GET["id"]; ?>&pad=<?php echo $_GET["pad"]; ?>',
				timeout: 2000,
				success: function(data) {
				  $("#sendAnswer").html(data);
				  window.setTimeout(update, 4000);
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
				  $("#sendAnswer").html('Timeout contacting server..');
				  window.setTimeout(update, 8000);
				}
			});
			}
			$(document).ready(function() {
				update();
			});
</script>