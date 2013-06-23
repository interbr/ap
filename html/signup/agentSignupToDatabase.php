<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$whyAgent = strip_tags($_POST["whyAgent"]);
$agentcontinent = strip_tags($_POST["agentContinent"]);
$wantedCategories = strip_tags($_POST["agentWantedCategories"]);
$unwantedCategories = strip_tags($_POST["agentUnwantedCategories"]);
$agentemail = strip_tags($_POST["agentaddress"]);
$agenttzone = strip_tags($_POST["agenttimezone"]);
if (isset($_POST['agenttime'])) {
$agenttime = strip_tags(implode(",",$_POST["agenttime"]));
}
else {
$agenttime = 'never'; };
$pcode = md5(uniqid(rand(), true));
$query = "INSERT INTO agents (whyAgent, continent, wanted, unwanted, email, agenttzone, agenttime, active, pcode) VALUES ('".$dbhandle->real_escape_string($whyAgent)."', '".$dbhandle->real_escape_string($agentcontinent)."', '".$dbhandle->real_escape_string($wantedCategories)."', '".$dbhandle->real_escape_string($unwantedCategories)."', '".$dbhandle->real_escape_string($agentemail)."', '".$dbhandle->real_escape_string($agenttzone)."', '".$dbhandle->real_escape_string($agenttime)."', '1', '".$dbhandle->real_escape_string($pcode)."')";
$dbhandle->query($query);
if (mysqli_affected_rows($dbhandle) == 1) {
echo "<div class=\"textdiv\">Thank you! Data saved.</div>"; }
else {
echo "<div class=\"textdiv\">Sorry, there was an error. Please retry or contact the system administrator.</div>"; };
$dbhandle->close();
?>