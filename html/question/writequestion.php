<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/question.php'); //a file with functions
?>
<div class="textdiv" id="writeQuestionIDInfo"><i>Now write your question:</i></div>
<div id="writeQuestionTextarea">
<div class="textdiv"> 
			<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
			<textarea id="content" rows="12" cols="50" name="content"><?php questionOpen(); ?></textarea></div>
			<div class="textdiv">
			<input id="clickPreviewquestion" type="submit" value="Preview">
			</form>	
</div>
</div>	
<script type="text/javascript">
$(function(){ /* Send Question-ID and Question to "savequestion.php" ans preview saved file */
		$('#clickPreviewquestion').click(function(){
		var question = $("textarea#content").val();
			var dataString = 'question=' + question;
 			$.ajax({
      			type: "POST",
      			url: "savequestion.php?id=<?php echo $_GET["id"]; ?>",
				data: dataString,
				complete: function () {				
		$('#previewQuestion').load('previewquestion.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		$('#writeQuestionIDInfo').slideUp(1000);
		}
		});
		return false; });
		});
</script>