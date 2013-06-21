<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$whyAgent = strip_tags($_POST["whyAgent"]);
$agentcontinent = strip_tags($_POST["agentContinent"]);
$wantedCategories =  strip_tags($_POST["agentWantedCategories"]);
$unwantedCategories =  strip_tags($_POST["agentUnwantedCategories"]);
$agentemail = strip_tags($_POST["agentaddress"]);
$pcode = md5(uniqid(rand(), true));
$query = "INSERT INTO agents (whyAgent, continent, wanted, unwanted, email, active, pcode) VALUES ('".$dbhandle->real_escape_string($whyAgent)."', '".$dbhandle->real_escape_string($agentcontinent)."', '".$dbhandle->real_escape_string($wantedCategories)."', '".$dbhandle->real_escape_string($unwantedCategories)."', '".$dbhandle->real_escape_string($agentemail)."', '1', '".$dbhandle->real_escape_string($pcode)."')";
$dbhandle->query($query);
if (mysql_errno() == 1062) {       
    print "<script type=\"text/javascript\">"; 
    print "alert('The informations are already inserted')"; 
    print "</script>";
  }
echo $dbhandle->errno . ": " . $dbhandle->error . "\n";
$dbhandle->close();

echo var_export($_POST);
?>