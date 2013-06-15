<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionid = $_GET["id"];
$agentcode =  $_GET["agentcode"];
$whopperQuery = $dbhandle->query("SELECT * FROM answer_whopper WHERE questionID='".$questionid."'");
while($row = $whopperQuery->fetch_assoc()) {
$agent1Status = $row['agent1'];
$agent2Status = $row['agent2'];
$agent3Status = $row['agent3'];
$agent4Status = $row['agent4'];
$agent5Status = $row['agent5'];
$currentAgentStatus = $row[$agentcode];
};
$dbhandle->close();
$status = array($agent1Status,$agent2Status,$agent3Status,$agent4Status,$agent5Status);
$satisfaction = array_sum($status);
?>
<div class="textdiv">
Agent1 = <?php echo $agent1Status; if ( $agentcode == "agent1" ) { echo " You!"; }; ?><br />
Agent2 = <?php echo $agent2Status; if ( $agentcode == "agent2" ) { echo " You!"; }; ?><br />
Agent3 = <?php echo $agent3Status; if ( $agentcode == "agent3" ) { echo " You!"; }; ?><br />
Agent4 = <?php echo $agent4Status; if ( $agentcode == "agent4" ) { echo " You!"; }; ?><br />
Agent5 = <?php echo $agent5Status; if ( $agentcode == "agent5" ) { echo " You!"; }; ?><br /><br />
<?php if ( $currentAgentStatus != "1" ) {
echo "<div id=\"satisfiedAnswerButton\"><button id=\"clickSatisfiedAnswer_".$_GET["agentcode"]."\">".$_GET["agentcode"].": Satisfied?</button><br /></div><br />"; }
else {
echo "<div id=\"cancelSatisfiedAnswerButton\"><button id=\"clickCancelSatisfiedAnswer_".$_GET["agentcode"]."\">".$_GET["agentcode"].": Mark \"Not satisfied\"?</button><br /></div><br />"; }; ?>
<?php if ( $satisfaction >= "3" ) {
echo "You are satisfied!<br /><br /><div id=\"previewAnswerButton\"><button id=\"clickPreviewAnswer\">".$_GET["agentcode"].": Stop answering. Preview.</button><br /></div>"; }
else {
echo "Not satisfied yet ..."; }; ?>
</div>
		<script type="text/javascript">
			$('#clickSatisfiedAnswer_<?php echo $_GET["agentcode"]; ?>').click(function(){
			$.ajax({
      			type: "POST",
      			url: "satisfiedAnswerToDatabaseWait.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>",
				});
			return false; });
			$('#clickCancelSatisfiedAnswer_<?php echo $_GET["agentcode"]; ?>').click(function(){
			$.ajax({
      			type: "POST",
      			url: "cancelSatisfiedAnswerToDatabaseWait.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>",
				});
			return false; });
			$('#clickPreviewAnswer').click(function(){
 			$.ajax({
      			type: "POST",
      			url: "savedAnswerProtect.php?id=<?php echo $_GET["id"]; ?>",
				});
			$('#answerdiv').load('savedanswerpreview.php?id=<?php echo $_GET["id"]; ?>').fadeIn(1000);
							return false; });
		</script>
