<?php 
$fy = "../../content/".$_GET["id"].".txt"; //questionfile
?>
<div id="previewQuestionSlide">
<div class="textdiv" id="previewQuestionInfo">Your question will be:</div>
<div class="textdiv" id="previewQuestionText">
<?php echo nl2br( file_get_contents($GLOBALS["fy"]) ); ?> <!-- preview questionfile-content with linebreaks -->
<br /><br />
ID is: <?php echo $_GET["id"]; ?>
<br />
</div>
<div class="textdiv" id="buttonCategorizeQuestion">
<button id="clickCategorizeQuestion">Categorize Question</button>
</div>
<div class="textdiv" id="buttonCategorizeQuestion_2">
<button id="clickCategorizeQuestion_2">Categorize Question</button>
</div>
</div>

<script type="text/javascript">

$(function(){ 
		$('#clickCategorizeQuestion').click(function(){
		$('#categorizeQuestion').load('categorizequestion.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		$('#writeQuestionTextarea').slideUp(1000);
		$('#previewQuestionInfo').slideDown(1000);
		$('#buttonCategorizeQuestion').slideUp(1000);
		return false; });
		});
$(function(){ 
		$('#clickCategorizeQuestion_2').click(function(){
		$('#categorizeQuestion').slideDown(1000);
		$('#writeQuestionTextarea').slideUp(1000);
		$('#previewQuestionInfo').slideDown(1000);
		$('#buttonCategorizeQuestion_2').slideUp(1000);
		return false; });
		});
</script>
