<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/php/configuration.php'); //a file with configurations
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<head>
		<title><?php echo $GLOBALS["sitetitle"] ?></title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Platform for people to write to and get questions answered by other people.">
		<link rel="stylesheet" href="/css/styles.css">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		</head>
		<body>
		<span class="aptitle"><a href="/"><?php echo $GLOBALS["titleslogan"] ?></a></span><br /><br />
        	<div class="page">
<div class="textdiv"><?php echo $GLOBALS["bodyslogan"] ?></div>
<div class="textdiv">The idea behind this website currently is:</div>
<div class="textdiv">Someone visits the website.</div>
<div class="textdiv">Writes a question.</div>
<div class="textdiv">This question is sent to 5 persons' (agents) emails.</div>
<div class="textdiv">If at least 3 of these 5 find a collective answer ...</div>
<div class="textdiv">... the answer is sent.</div>
<div class="textdiv">Main problem:</div>
<div class="textdiv">Many people have questions ...</div>
<div class="textdiv">... but how make the "agents" answer?</div>
<div class="textdiv">Well,</div>
<div class="textdiv">current approach is to make them meet 30 minutes after they receive the question.</div>
<div class="textdiv">If you sign up as an agent, you can say at which daytime you can answer questions. At any time you can pause or reactivate your account.</div>
<div class="textdiv">When an agent follows the link from the sent question-email, the agent can meet the other 4 on a website with a realtime-textprocessing software (etherpad-lite).</div>
<div class="textdiv">If the agent has no time, another link in the email allows to forward the question to a new agent from the database.</div>
<div class="textdiv">Thank you for testing, suggestions, amore!</div>
<div class="textdiv">Program-code-site: <a href="https://github.com/interbr/amored-police">at github</a></div>
<div class="textdiv"><a href="/">Start</a> | <a href="mailto:<?php echo $GLOBALS["siteemail"] ?>">Contact</a></div>
		</div>
		</body>
</html>
