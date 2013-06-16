<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$questionID = $_GET["id"];
$agentNo = $_GET["agentcode"];
$authorIDGET = $_GET["authorID"];
$cookieToSetQuery = $dbhandle->query("SELECT * FROM answer_access WHERE questionID='".$questionID."' AND $agentNo='".$authorIDGET."'");
while($cookieRow = $cookieToSetQuery->fetch_assoc()) {
$sessionIDColumn = $agentNo."sessionID";
$cookieToSet = $cookieRow["".$sessionIDColumn.""];
$cookieTime = $cookieRow['timetoanswerSession'];
};
setcookie("sessionID", $cookieToSet, $cookieTime, "/", $GLOBALS["etherpadcookiehost"]);
?>