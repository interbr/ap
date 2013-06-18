<?php 
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/../php/configuration.php');
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$queryReadyAll = "UPDATE answer_start_system SET ready = '1' WHERE questionID = '".$_GET["id"]."'";
$dbhandle->query($queryReadyAll);
$dbhandle->close();
?>