<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<head>
		<title>Help Desk for Earth\' Peoples Problems (except IT) - github-project - amored-police</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Platform for people to write to and get questions answered by other people.">
		<link rel="stylesheet" href="/css/styles.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<script type="text/javascript" src="/js/jquery-1.10.1.min.js"></script>
		</head>
		<body>
		<span class="aptitle"><a href="/">Amored&nbsp;Police</a></span><br /><br />
        <div class="page">
		<div class="textdiv">
		<div id="forwardResult">
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
			$.ajax({
				type:'POST',
				url:'forwardMail.php?id=<?php echo $_GET["id"]; ?>&agentcode=<?php echo $_GET["agentcode"]; ?>&authorID=<?php echo $_GET["authorID"]; ?>',
				success: function(data) {
				  $("#forwardResult").html(data);
				}
			});
return false;
});
</script>
</body>
</html>