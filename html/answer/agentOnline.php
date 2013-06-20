<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionid = $_GET["id"];
$agentcode = $_GET['agentcode'];
$agentOnlineQuery = $dbhandle->query("SELECT * FROM answer_start_system WHERE questionID='".$questionid."'");
while($row = $agentOnlineQuery->fetch_assoc()) {
$agent1Online = $row['agent1'];
$agent2Online = $row['agent2'];
$agent3Online = $row['agent3'];
$agent4Online = $row['agent4'];
$agent5Online = $row['agent5'];
$currentAgentOnline = $row[$agentcode];
$ready = $row['ready'];
};
$dbhandle->close();
$onlinearray = array($agent1Online,$agent2Online,$agent3Online,$agent4Online,$agent5Online);
$onlinetotal = array_sum($onlinearray);

$agent1_text = $agent1Online == 1 ? "Ready!" : "Offline?";
$agent2_text = $agent2Online == 1 ? "Ready!" : "Offline?";
$agent3_text = $agent3Online == 1 ? "Ready!" : "Offline?";
$agent4_text = $agent4Online == 1 ? "Ready!" : "Offline?";
$agent5_text = $agent5Online == 1 ? "Ready!" : "Offline?";

?>
<div>
<center>
<table>
<tr><td>Agent1 is </td><td><?php echo $agent1_text; ?></td><td><?php if ( $agentcode == "agent1" ) { echo "You!"; } ?></td><td><?php if ( $agentcode == "agent1" and $agent1Online != "1" ) { echo "<button id=\"clickReady_".$_GET["agentcode"]."\">Mark yourself ready!</button>"; }; ?></td></tr>
<tr><td>Agent2 is </td><td><?php echo $agent2_text; ?></td><td><?php if ( $agentcode == "agent2" ) { echo "You!"; } ?></td><td><?php if ( $agentcode == "agent2" and $agent2Online != "1" ) { echo "<button id=\"clickReady_".$_GET["agentcode"]."\">Mark yourself ready!</button>"; }; ?></td></tr>
<tr><td>Agent3 is </td><td><?php echo $agent3_text; ?></td><td><?php if ( $agentcode == "agent3" ) { echo "You!"; } ?></td><td><?php if ( $agentcode == "agent3" and $agent3Online != "1" ) { echo "<button id=\"clickReady_".$_GET["agentcode"]."\">Mark yourself ready!</button>"; }; ?></td></tr>
<tr><td>Agent4 is </td><td><?php echo $agent4_text; ?></td><td><?php if ( $agentcode == "agent4" ) { echo "You!"; } ?></td><td><?php if ( $agentcode == "agent4" and $agent4Online != "1" ) { echo "<button id=\"clickReady_".$_GET["agentcode"]."\">Mark yourself ready!</button>"; }; ?></td></tr>
<tr><td>Agent5 is </td><td><?php echo $agent5_text; ?></td><td><?php if ( $agentcode == "agent5" ) { echo "You!"; } ?></td><td><?php if ( $agentcode == "agent5" and $agent5Online != "1" ) { echo "<button id=\"clickReady_".$_GET["agentcode"]."\">Mark yourself ready!</button>"; }; ?></td></tr>
</table>
</center>
<br />
<?php if ( $onlinetotal >= "3" ) {
echo "You are ready!<br /><br /><div id=\"readyAnswerButton\"><button id=\"clickStartAnswer\">Start answering.</button><br /></div>"; }
else {
echo "Not ready yet ..."; }; ?>
</div>
<script type="text/javascript">
		function startquestion() {
			var loadlink = '/answer/answer.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>&authorID=<?php echo $_GET["authorID"] ?>';
			$.ajax({
      			type: "POST",
      			url: "setSessionCookie.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>&authorID=<?php echo $_GET["authorID"]; ?>&groupID=<?php $_GET["groupID"]; ?>",
				complete: function() {
				$("#answerdiv").load(loadlink).fadeIn(1000);
				}
				});
				}
				<?php if ( $ready == "1" ) { 
				echo "$(document).ready(function() { startquestion(); });"; }; ?>				
			$("#clickReady_<?php echo $_GET["agentcode"]; ?>").click(function(){
			$.ajax({
      			type: "POST",
      			url: "readyToDatabase.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>",
				});
			return false; });
			$('#clickStartAnswer').click(function(){
 			$.ajax({
      			type: "POST",
				url: "setSessionCookie.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>&authorID=<?php echo $_GET["authorID"]; ?>&groupID=<?php $_GET["groupID"]; ?>",
				success: function(){  
					$.ajax ({  
					type: 'POST',
					url: "startAnswerAll.php?id=<?php echo $_GET["id"]; ?>",
					complete: function() {
					$('#answerdiv').load('/answer/answer.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>&authorID=<?php echo $_GET["authorID"] ?>').fadeIn(1000).clearTimeout(updateonlinetimer);
				}
				});
				}
				});
							return false; });
							
		</script>