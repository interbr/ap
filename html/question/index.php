<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/question.php'); // a functions file
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<head>
		<title>Help Desk for Earth' Peoples Problems (except IT) - github-project - amored-police</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Platform for people to write to and get questions answered by other people.">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Expires" content="-1">
		<link rel="stylesheet" href="/css/styles.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/js/custom.js"></script>
		<script type="text/javascript">
		$(function(){
		$('#clickOpenquestion').click(function(){
		$('#start').slideUp('slow');
		$('#openQuestion').load('openquestion.php?id=<?php echo $GLOBALS["idNum"]; ?>').hide().fadeIn(1000);
		return false; });
		});
		</script>
		</head>
		<body> 
		<span style="color: #fff; font-size: 18px; font-family: courier">Amored&nbsp;Police</span><br /><br />
        <div class="page">
		<div id="start" class="textdiv"><button id="clickOpenquestion">Open Question</button></div> <!-- get random ID from "question.php", preview ID and show button to write to .txt-file ID.txt -->
		<div id="openQuestion"></div>
		<div id="writeQuestion"></div>
		<div id="previewQuestion"></div>
		<div id="categorizeQuestionDiv"></div>
		<div id="savedQuestionPrepare"></div>
		<div id="createActivationResult"></div>
        </div>
    </body>
</html>