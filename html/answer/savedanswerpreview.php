<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/answering-system.php'); //a file with etherpad-api-class
$instance = new EtherpadLiteClient('uWCqxbEXfd9ujGzinDcY4kagzgshEV9h', 'http://localhost:9001/api');
try {
  $padContents = $instance->getText($_GET["id"]);
  $answerPreview = nl2br( $padContents->text );
  echo "The Answer is as follows:<br /><br />$answerPreview<br /><br />";
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "\n\ngetText Failed with message ". $e->getMessage();
}
?>
<div id="sendAnswerButton"><button id="clickSendAnswer">Send Answer</button></div>
<div id="answerSentResult"></div>
<script type="text/javascript">
$(function(){ 
		$('#clickSendAnswer').click(function(){
 			$.ajax({
      			type: "POST",
      			url: "sendanswer.php?id=<?php echo $_GET["id"]; ?>",
				});
		$('#answerSentResult').load('answersentresult.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		$('#sendAnswerButton').slideUp(1000);
						return false; });
		});
</script>