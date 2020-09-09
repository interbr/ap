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
<script type="text/javascript">
function update2() {	
 			$.ajax({
      			type: "POST",
      			url: "sendanswerTeam.php?id=<?php echo $_GET['id']; ?>&pad=<?php echo $_GET['pad']; ?>",
				success: function() {
				$("#sendAnswer").load('answerSentTeam.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
				}
				});
				}
        $(document).ready(function() {
				  update2();
			  });
</script>
<?php if ( $sentStatus == "1" ) {
echo "Answer has been sent to Team!"; } ?>
