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
$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadhost"].'/api');
try {
  $padContents = $instance->getText($_GET["pad"]);
  $answerPreview = nl2br( $padContents->text );
  echo "<div class=\"textdiv\">The Answer is as follows:<br /><br />$answerPreview<br /></div>";
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "<div class=\"textdiv\">getText Failed with message ". $e->getMessage()."</div>";
}
?>
<div class="textdiv" id="sendAnswerButton"><button id="clickSendAnswer">Send Answer</button></div>
<div id="answerSentResult"></div>
<script type="text/javascript">
$(function(){ 
		$('#clickSendAnswer').click(function(){
 			$.ajax({
      			type: "POST",
      			url: "sendanswer.php?id=<?php echo $_GET["id"]; ?>&pad=<?php echo $_GET["pad"]; ?>",
				complete: function() {
				$('#answerSentResult').load('answersentresult.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
				$('#sendAnswerButton').slideUp(1000);
				}
				});
						return false; });
		});
		function update() {	
			}
			$(document).ready(function() {
				update();
			});
</script>