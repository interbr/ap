<?php
$questionFilePath = "../content/".$_GET["id"].".txt";

$subject = "Test-Question " . $_GET["id"];
$msg = file_get_contents($GLOBALS["questionFilePath"]);

$username="ap-db-client";
$password="cmCmSaDh7R8NbNUr";
$database="amored-police";

mysql_connect('localhost',$username,$password);
mysql_select_db($database) or die( "Unable to select database");

$query = "SELECT * FROM agents ORDER BY RAND() LIMIT 0,1";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
$agent1 = $row["email"];
}
mysql_close();




// mail settings
$agent_address = $agent1;
$headers = "From: no-reply@amored-police.org\r\n" .
	"Reply-To: no-reply@amored-police.org\r\n" .
    "Content-type:  text/plain; charset=utf-8";
$message = "Question is:\n\n $msg";
// send mail
mail($agent_address, $subject, $message, $headers);
?>