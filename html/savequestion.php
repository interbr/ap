<?php
$content = $_POST['question'];
$fw = "../content/".$_GET["id"].".txt";

    $fp = fopen($GLOBALS["fw"],"w") or die ("Error opening file in write mode!");
    fputs($fp,$content); // write textarea-content (question) to questionfile
    fclose($fp) or die ("Error closing file!"); 
?> 