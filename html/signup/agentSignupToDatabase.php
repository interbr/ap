<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$whyAgent = mysqli_real_escape_string($dbhandle,$_POST["whyAgent"]);
$agentcontinent = $_POST["agentContinent"];
$wantedCategories =  implode(",",$_POST["agentWantedCategories"]);
$unwantedCategories =  implode(",",$_POST["agentUnwantedCategories"]);
$agentemail = $_POST["agentaddress"];
$query = "INSERT INTO agents (whyAgent, continent, wanted, unwanted, email) VALUES ('".$whyAgent."', '".$agentcontinent."', '".$wantedCategories."', '".$unwantedCategories."', '".$agentemail."')";
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