<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionid = $_GET["id"];
$answerSentStatusQuery = $dbhandle->query("SELECT * FROM questions WHERE questionID='".$questionid."'");
while($row = $answerSentStatusQuery->fetch_assoc()) {
$sentStatus = $row['answer_sent'];
};
$dbhandle->close();
?>
<?php if ( $sentStatus != "1" ) {
echo "<div id=\"sendAnswerButton\"><button id=\"clickSendAnswer\">Send Answer</button></div>"; }
else {
echo "Answer has been sent!"; }; ?>
<script type="text/javascript">
$(function(){ 
		$('#clickSendAnswer').click(function(){
 			$.ajax({
      			type: "POST",
      			url: "sendanswer.php?id=<?php echo $_GET['id']; ?>&pad=<?php echo $_GET['pad']; ?>",
				success: function() {
				$("#sendAnswer").load('answerSent.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
				}
				});
						return false; });
		});
</script>
