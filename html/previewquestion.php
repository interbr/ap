<?php 
$fy = "../content/".$_GET["id"].".txt"; //questionfile
?>
<br /><?php echo nl2br( file_get_contents($GLOBALS["fy"]) ); ?> <!-- preview questionfile-content with linebreaks -->
<br /><br />
ID is: <?php echo $_GET["id"]; ?>
<br />
<button id="clickSendquestion">Send Question</button>
<script type="text/javascript">
$(function(){ /* send question-ID to "sendquestion.php" and load result-message */
		$('#clickSendquestion').click(function(){
 			$.ajax({
      			type: "POST",
      			url: "sendquestion.php?id=<?php echo $_GET["id"]; ?>",
				});
		$('#questionSent').load('/questionsent.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		return false; });
		});
</script>
