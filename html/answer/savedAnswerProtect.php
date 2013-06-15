<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/answering-system.php'); //a file with etherpad-api-class
require_once(__ROOT__.'/../php/configuration.php');
$instance = new EtherpadLiteClient($GLOBALS["etherpadapikey"], $GLOBALS["etherpadhost"].'/api');
try {
  $instance->setPassword($_GET["id"],'aPassword');
} catch (Exception $e) {
  // the pad already exists or something else went wrong
  echo "\n\nsetPassword Failed with message ". $e->getMessage();
}
?>