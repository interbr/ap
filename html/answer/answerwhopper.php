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
$answered = $row['answered'];
};
$dbhandle->close();
$status = array($agent1Status,$agent2Status,$agent3Status,$agent4Status,$agent5Status);
$satisfaction = array_sum($status);

$agent1status_text = $agent1Status == 1 ? "<span style=\"color: #00ff00;\">Satisfied!</span>" : "<span style=\"color: #ff0000;\">Not Satisfied.</span>";
$agent2status_text = $agent2Status == 1 ? "<span style=\"color: #00ff00;\">Satisfied!</span>" : "<span style=\"color: #ff0000;\">Not Satisfied.</span>";
$agent3status_text = $agent3Status == 1 ? "<span style=\"color: #00ff00;\">Satisfied!</span>" : "<span style=\"color: #ff0000;\">Not Satisfied.</span>";
$agent4status_text = $agent4Status == 1 ? "<span style=\"color: #00ff00;\">Satisfied!</span>" : "<span style=\"color: #ff0000;\">Not Satisfied.</span>";
$agent5status_text = $agent5Status == 1 ? "<span style=\"color: #00ff00;\">Satisfied!</span>" : "<span style=\"color: #ff0000;\">Not Satisfied.</span>";
?>
<div class="textdiv">
<center>
<table>
<tr><td>Agent1 = </td><td><?php echo $agent1status_text; ?></td><td><?php if ( $agentcode == "agent1" ) { echo " You!"; }; ?></td></tr>
<tr><td>Agent2 = </td><td><?php echo $agent2status_text; ?></td><td><?php if ( $agentcode == "agent2" ) { echo " You!"; }; ?></td></tr>
<tr><td>Agent3 = </td><td><?php echo $agent3status_text; ?></td><td><?php if ( $agentcode == "agent3" ) { echo " You!"; }; ?></td></tr>
<tr><td>Agent4 = </td><td><?php echo $agent4status_text; ?></td><td><?php if ( $agentcode == "agent4" ) { echo " You!"; }; ?></td></tr>
<tr><td>Agent5 = </td><td><?php echo $agent5status_text; ?></td><td><?php if ( $agentcode == "agent5" ) { echo " You!"; }; ?></td></tr>
</table>
</center><br />
<?php if ( $currentAgentStatus != "1" ) {
echo "<div id=\"satisfiedAnswerButton\"><button id=\"clickSatisfiedAnswer_".$_GET["agentcode"]."\">".$_GET["agentcode"].": Satisfied?</button><br /></div><br />"; }
else {
echo "<div id=\"cancelSatisfiedAnswerButton\"><button id=\"clickCancelSatisfiedAnswer_".$_GET["agentcode"]."\">".$_GET["agentcode"].": Mark \"Not satisfied\"?</button><br /></div><br />"; }; ?>
<?php if ( $satisfaction >= "2" ) {
echo "You are satisfied!<br /><br /><div id=\"previewAnswerButton\"><button id=\"clickPreviewAnswer\">".$_GET["agentcode"].": Stop answering. Preview.</button><br /></div>"; }
else {
echo "Not satisfied yet ..."; }; ?><br /><br />
<i>When at least 2 of 5 agents have marked "satisfied",<br />the answer can be saved.<br />
You will hear a sound when the answer is saved</i>
</div>
		<script type="text/javascript">
		function closequestion() {
			var loadlink = 'savedanswerpreview.php?id=<?php echo $_GET["id"]; ?>&pad=<?php echo $_GET["pad"]; ?>';
			$("#answerdiv").load(loadlink).fadeIn(1000);
			}			
				<?php if ( $answered == "1" ) { 
				echo "playbell(); $(document).ready(function() { closequestion(); });"; } else { echo ";"; }; ?>
				
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
				complete: function() {
				playbell();
				$('#answerdiv').load('savedanswerpreview.php?id=<?php echo $_GET["id"]; ?>&pad=<?php echo $_GET["pad"]; ?>').fadeIn(1000);
				}
				});
							return false; });
		</script>
