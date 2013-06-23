<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
 $_GET['email'])) {
 $email = strip_tags($_GET['email']);
}
if (isset($_GET['pcode']) && (strlen($_GET['pcode']) == 32))
 {
 $pcode = strip_tags($_GET['pcode']);
}
if (isset($_GET['delete']) && (strlen($_GET['delete']) == 1))
 {
 $deletewanted = strip_tags($_GET['delete']);
}

if (isset($email) && isset($pcode) && isset($deletewanted)) {

 $query_delete_agent_account = "DELETE FROM agents WHERE(email ='".$dbhandle->real_escape_string($email)."' AND pcode='".$dbhandle->real_escape_string($pcode)."')LIMIT 1";
 $dbhandle->query($query_delete_agent_account);
 mysqli_close($dbhandle);
 };
?>