<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/answering-system.php'); //a file with etherpad-api-class
require_once(__ROOT__.'/../php/configuration.php');
$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadapihost"].'/api');
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$padToCloseRow = $dbhandle->query("SELECT * FROM answer_access WHERE questionID='".$_GET["id"]."'");
while($row = $padToCloseRow->fetch_assoc()) {
$padToClose = $row['padID'];
};
$queryPassword = "UPDATE answer_access SET padPassword = '88888888' WHERE questionID = '".$_GET["id"]."'";
$dbhandle->query($queryPassword);
$queryAnswered = "UPDATE answer_whopper SET answered = '1' WHERE questionID = '".$_GET["id"]."'";
$dbhandle->query($queryAnswered);
$dbhandle->close();
try {
  $instance->setPassword($padToClose,'88888888');
} catch (Exception $e) {
  echo "Etherpad-Error (protect)";
}
?>