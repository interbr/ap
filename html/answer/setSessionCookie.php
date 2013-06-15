<?php 
date_default_timezone_set("UTC");
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/answering-system.php'); //a file with etherpad-api-class
require_once(__ROOT__.'/../php/configuration.php');
$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadcookiehost"].'/api');
$validUntil = time()+14400; // One day in the future
$sessionID = $instance->createSession($_GET["groupID"], $_GET["authorID"], $validUntil);
echo "New Session ID is $sessionID->sessionID\n\n";
$value = $sessionID->sessionID;
setcookie("sessionID", $value, time()+14400, "/");
?>