<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
session_start();
$questionID = $_SESSION['questionID'];
$openQuestionQuery = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$dbhandle->real_escape_string($questionID)."'");
?>
<div id="previewQuestionSlide">
<div class="textdiv" id="previewQuestionInfo"><i>Your question will be:</i></div>
<div class="textdiv" id="previewQuestionText">
<?php while($openSaveRow = $openQuestionQuery->fetch_assoc()) { echo $openSaveRow["questionText"]; }; ?> <!-- preview questionfile-content with linebreaks -->
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
