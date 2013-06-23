<?php 
$fy = "../../content/".$_GET["id"].".txt"; //questionfile
?>
<div id="previewQuestionSlide">
<div class="textdiv" id="previewQuestionInfo"><i>Your question will be:</i></div>
<div class="textdiv" id="previewQuestionText">
<?php echo strip_tags(nl2br( file_get_contents($GLOBALS["fy"]) ) ); ?> <!-- preview questionfile-content with linebreaks -->
</div>
<div class="textdiv" id="buttonCategorizeQuestion">
<button id="clickCategorizeQuestion">Categorize Question</button>
</div>
</div>

<script type="text/javascript">

$(function(){ 
		$('#clickCategorizeQuestion').click(function(){
		$('#categorizeQuestionDiv').load('categorizequestion.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		$('#writeQuestionTextarea').slideUp(1000);
		$('#previewQuestionInfo').slideDown(1000);
		$('#buttonCategorizeQuestion').slideUp(1000);
		return false; });
		});
</script>
