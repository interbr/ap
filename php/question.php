<?php
if (empty($idNum)) {
$length = 12;
$randomString = substr(str_shuffle("123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ"), 0, $length);
$idNum = $randomString; //generate 12-digit-random-ID that will be assigned to question
}

$fn = "../content/".$GLOBALS["idNum"].".txt"; // questionfile

function questionOpen () { // read questionfile-content ..
if (file_exists($GLOBALS["fn"])) {
	readfile($GLOBALS["fn"]);
}
else { // .. or create questionfile and read (empty) content
	$touch = fopen($GLOBALS["fn"], "w");
	fclose($touch);
	readfile($GLOBALS["fn"]);
}
}

?>