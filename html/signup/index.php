<?php
$m12 = date("H:i:s",mktime(gmdate("H")-12));
$m11 = date("H:i:s",mktime(gmdate("H")-11));
$m10 = date("H:i:s",mktime(gmdate("H")-10));
$m9 = date("H:i:s",mktime(gmdate("H")-9));
$m8 = date("H:i:s",mktime(gmdate("H")-8));
$m7 = date("H:i:s",mktime(gmdate("H")-7));
$m6 = date("H:i:s",mktime(gmdate("H")-6));
$m5 = date("H:i:s",mktime(gmdate("H")-5));
$m4 = date("H:i:s",mktime(gmdate("H")-4));
$m3 = date("H:i:s",mktime(gmdate("H")-3));
$m2 = date("H:i:s",mktime(gmdate("H")-2));
$m1 = date("H:i:s",mktime(gmdate("H")-1));
$m0 = date("H:i:s",mktime(gmdate("H")-0));
$p1 = date("H:i:s",mktime(gmdate("H")+1));
$p2 = date("H:i:s",mktime(gmdate("H")+2));
$p3 = date("H:i:s",mktime(gmdate("H")+3));
$p4 = date("H:i:s",mktime(gmdate("H")+4));
$p5 = date("H:i:s",mktime(gmdate("H")+5));
$p6 = date("H:i:s",mktime(gmdate("H")+6));
$p7 = date("H:i:s",mktime(gmdate("H")+7));
$p8 = date("H:i:s",mktime(gmdate("H")+8));
$p9 = date("H:i:s",mktime(gmdate("H")+9));
$p10 = date("H:i:s",mktime(gmdate("H")+10));
$p11 = date("H:i:s",mktime(gmdate("H")+11));
$timezones = 
array (
  'Please choose' => '',
  ' '.$m12.'  (GMT-12:00)' => 'Pacific/Wake',
  ' '.$m11.'  (GMT-11:00)' => 'Pacific/Apia',
  ' '.$m10.'  (GMT-10:00)' => 'Pacific/Honolulu',
  ' '.$m9.'  (GMT-09:00)' => 'America/Anchorage',
  ' '.$m8.'  (GMT-08:00)' => 'America/Los_Angeles',
  ' '.$m7.'  (GMT-07:00)' => 'America/Chihuahua',
  ' '.$m6.'  (GMT-06:00)' => 'America/Chicago',
  ' '.$m5.'  (GMT-05:00)' => 'America/Bogota',
  ' '.$m4.'  (GMT-04:00)' => 'America/Caracas',
  ' '.$m3.'  (GMT-03:00)' => 'America/Sao_Paulo',
  ' '.$m2.'  (GMT-02:00)' => 'America/Noronha',
  ' '.$m1.'  (GMT-01:00)' => 'Atlantic/Azores',
  ' '.$m0.'  (GMT)' => 'Europe/London',
  ' '.$p1.'  (GMT+01:00)' => 'Europe/Berlin',
  ' '.$p2.'  (GMT+02:00)' => 'Europe/Istanbul',
  ' '.$p3.'  (GMT+03:00)' => 'Europe/Moscow',
  ' '.$p4.'  (GMT+04:00)' => 'Asia/Tbilisi',
  ' '.$p5.'  (GMT+05:00)' => 'Asia/Karachi',
  ' '.$p6.'  (GMT+06:00)' => 'Asia/Novosibirsk',
  ' '.$p7.'  (GMT+07:00)' => 'Asia/Bangkok',
  ' '.$p8.'  (GMT+08:00)' => 'Asia/Hong_Kong',
  ' '.$p9.'  (GMT+09:00)' => 'Asia/Seoul',
  ' '.$p10.'  (GMT+10:00)' => 'Australia/Sydney',
  ' '.$p11.'  (GMT+11:00)' => 'Asia/Magadan',
);
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');
$getCategories = $dbhandle->query("SELECT * FROM question_categories WHERE(status='1')");
$getContinents = $dbhandle->query("SELECT * FROM agents_continents");
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
		<script type="text/javascript" src="/js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/js/jquery.blockUI.js"></script>
		<script type="text/javascript" src="/js/custom.js"></script>
		</head>
		<body>
		<span class="aptitle"><a href="/"><?php echo $GLOBALS["titleslogan"] ?></a></span><br /><br />
        	<div class="page">
		<div class="textdiv"><?php echo $GLOBALS["bodyslogan"] ?></div>
		<div id="signupFormDiv">
		<form id="signup" name="signup" class="signup" method="post">
<div class="textdiv">Why do you want to answer anonymous questions on a regular basis:</div>
<textarea name="whyAgent" cols="50" rows="8" maxlength="2000">Hey, it's me!</textarea>
<br />
<div class="textdiv">Which Continent are you from:</div>
<div class="textdiv">
<ul>
	<?php foreach($getContinents as $getContinentsValue){
		echo 	"<li>
				<div><input type=\"radio\" name=\"agentContinent\" value=\"".$getContinentsValue["continent"]."\" id=\"".$getContinentsValue["continent"]."\" required /><label for=\"".$getContinentsValue["continent"]."\">".$getContinentsValue["continent"]."</label></div>
				</li>"; }
	?>
</ul>
</div>
<div class="textdiv">What time is it where you are (Timezone):</div>
<div class="textdiv">
	<select name="agenttimezone" class="timezoner" size="1" required >
		<?php foreach($timezones as $tzone => $tzonesave){
		echo "<option value=\"".$tzonesave."\">".$tzone."</option>";
		} ?>
    </select>
</div>
<div class="textdiv">When do you want to receive questions (in your local time):</div>
<div class="textdiv">
	<center>
	<table>
	<tr>
	<td width="50px"><center><label for="0-6">0-6</label></center></td><td width="50px"><center><label for="6-10">6-10</label></center></td><td width="50px"><center><label for="10-12">10-12</label></center></td><td width="50px"><center><label for="12-15">12-15</label></center></td><td width="50px"><center><label for="15-18">15-18</label></center></td><td width="50px"><center><label for="18-20">18-20</label></center></td><td width="50px"><center><label for="20-22">20-22</label></center></td><td width="50px"><center><label for="22-0">22-24</label></center></td>
	</tr>
	<tr>
	<td><center><input type="checkbox" name="agenttime[]" value="0-6" id="0-6" class="boxchecked" checked="checked" /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="6-10" id="6-10" class="boxchecked" checked="checked" /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="10-12" id="10-12" class="boxchecked" checked="checked" /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="12-15" id="12-15" class="boxchecked" checked="checked" /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="15-18" id="15-18" class="boxchecked" checked="checked" /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="18-20" id="18-20" class="boxchecked" checked="checked" /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="20-22" id="20-22" class="boxchecked" checked="checked" /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="22-24" id="22-24" class="boxchecked" checked="checked" /></center></td>
	</tr>
	</table>
	</center>
</div>
<div class="textdiv">Category you are good in:</div>
<div class="textdiv">
<ul>
	<?php foreach($getCategories as $getCategoriesWanted){
		echo 	"<li>
				<div><input type=\"radio\" name=\"agentWantedCategories\" value=\"".$getCategoriesWanted["category"]."\" id=\"awc-".$getCategoriesWanted["category"]."\" required /><label for=\"awc-".$getCategoriesWanted["category"]."\">".$getCategoriesWanted["category"]."</label></div>
				</li>";}
	?>
</ul>
</div>
<div class="textdiv">Category you don't want to answer:</div>
<div class="textdiv">
<ul>     
	<?php foreach($getCategories as $getCategoriesUnwanted){
		echo 	"<li>
				<div><input type=\"radio\" name=\"agentUnwantedCategories\" value=\"".$getCategoriesUnwanted["category"]."\" id=\"anc-".$getCategoriesUnwanted["category"]."\" required /><label for=\"anc-".$getCategoriesUnwanted["category"]."\">".$getCategoriesUnwanted["category"]."</label></div>
				</li>";}
		 mysqli_close($dbhandle);
	?>
</ul>
</div>
<div class="textdiv">The email to send questions to (Your email): <input name="agentaddress" type="email" id="agentaddress" required /></div>
<div class="textdiv"><input id="submit" type="submit" name="submit" value="Signup" /></div>
</form>
</div>
<div id="signupResult"></div>
        </div>
<script type="text/javascript">
		$( document ).ready(function() {
		$('#signup').submit(function() {
		$("#signup").validate();
		$.blockUI({ message: '<br />sending ...<br /><br />' });
            var form = document.signup;
			var dataString = $(form).serialize();
			$.ajax({
				cache: false,
				type:'POST',
				url:'agentSignupToDatabase.php',
				data: dataString,
				success: function(data) {
				$.unblockUI();
				  $('#signupFormDiv').slideUp(1000);
				  $("#signupResult").html(data);
				}
			});
return false;
});
});
</script>
    </body>
</html>
