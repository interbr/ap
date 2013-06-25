<?php
$timezones = 
array (
  'Please choose' => 'none',
  '(GMT-12:00) International Date Line West' => 'Pacific/Wake',
  '(GMT-11:00) Samoa' => 'Pacific/Apia',
  '(GMT-10:00) Hawaii' => 'Pacific/Honolulu',
  '(GMT-09:00) Alaska' => 'America/Anchorage',
  '(GMT-08:00) Pacific Time (US &amp; Canada); Tijuana' => 'America/Los_Angeles',
  '(GMT-07:00) La Paz' => 'America/Chihuahua',
  '(GMT-06:00) Central Time (US &amp; Canada)' => 'America/Chicago',
  '(GMT-05:00) Bogota' => 'America/Bogota',
  '(GMT-04:00) Caracas' => 'America/Caracas',
  '(GMT-03:00) Brasilia' => 'America/Sao_Paulo',
  '(GMT-02:00) Mid-Atlantic' => 'America/Noronha',
  '(GMT-01:00) Azores' => 'Atlantic/Azores',
  '(GMT) London' => 'Europe/London',
  '(GMT+01:00) Berlin, Lagos' => 'Europe/Berlin',
  '(GMT+02:00) Istanbul' => 'Europe/Istanbul',
  '(GMT+03:00) Moscow' => 'Europe/Moscow',
  '(GMT+04:00) Tbilisi' => 'Asia/Tbilisi',
  '(GMT+05:00) Karachi' => 'Asia/Karachi',
  '(GMT+06:00) Novosibirsk' => 'Asia/Novosibirsk',
  '(GMT+07:00) Bangkok' => 'Asia/Bangkok',
  '(GMT+08:00) Hong Kong' => 'Asia/Hong_Kong',
  '(GMT+09:00) Seoul' => 'Asia/Seoul',
  '(GMT+10:00) Sydney' => 'Australia/Sydney',
  '(GMT+11:00) New Caledonia' => 'Asia/Magadan',
);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<head>
		<title>Help Desk for Earth' Peoples Problems (except IT) - github-project - amored-police</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Platform for people to write to and get questions answered by other people.">
		<link rel="stylesheet" href="/css/styles.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<script type="text/javascript" src="/js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/js/custom.js"></script>
		</head>
		<body>
		<span class="aptitle"><a href="/">Amored&nbsp;Police</a></span><br /><br />
        <div class="page">
		<div class="textdiv">Help-Desk for Earth' Peoples Problems (except IT)</div>
		<div id="signupFormDiv">
		<form id="signup" name="signup" class="signup" method="post">
<div class="textdiv">Why do you want to answer anonymous questions on a regular basis:</div>
<textarea name="whyAgent" cols="50" rows="8" maxlength="2000">Hey, it's me!</textarea>
<br />
<div class="textdiv">Which Continent are you from:</div>
<div class="textdiv">
<ul>
	<li>
        <div><input type="radio" name="agentContinent" value="Dontask" id="Dontask" required /><label for="Dontask">Don't ask</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentContinent" value="Africa" id="Africa" /><label for="Africa">Africa</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentContinent" value="Asia" id="Asia" /><label for="Asia">Asia</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentContinent" value="Europe" id="Europe" /><label for="Europe">Europe</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentContinent" value="Islands" id="Islands" /><label for="Islands">Islands</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentContinent" value="North-America" id="North-America" /><label for="North-America">North-America</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentContinent" value="South-America" id="South-America" /><label for="South-America">South-America</label></div>
    </li>
</ul>
</div>
<div class="textdiv">Which Timezone are you in:</div>
<div class="textdiv">
	<select name="agenttimezone" class="timezoner" size="1">
		<?php foreach($timezones as $tzone => $tzonesave){
		echo "<option value=\"".$tzonesave."\">".$tzone."</option>";
		} ?>
    </select>
	<br /><br />
	Current time (GMT): <?php echo gmdate("H:i:s"); ?>
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
	<li>
        <div><input type="radio" name="agentWantedCategories" value="All-wanted" id="All-wanted" required /><label for="All-wanted">All wanted</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentWantedCategories" value="Planet" id="Planet" /><label for="Planet">Planet</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentWantedCategories" value="World" id="World" /><label for="World">World</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentWantedCategories" value="Hygiene" id="Hygiene" /><label for="Hygiene">Hygiene</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentWantedCategories" value="Philosophy" id="Philosophy" /><label for="Philosophy">Philosophy</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentWantedCategories" value="Psychology" id="Psychology" /><label for="Psychology">Psychology</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentWantedCategories" value="Food" id="Food"  /><label for="Food">Food</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentWantedCategories" value="Gardening-and-Agriculture" id="Gardening-and-Agriculture" /><label for="Gardening-and-Agriculture">Gardening and Agriculture</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentWantedCategories" value="Occupation" id="Occupation" /><label for="Occupation">Occupation</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentWantedCategories" value="Flowers" id="Flowers" /><label for="Flowers">Flowers</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentWantedCategories" value="Peace" id="Peace" /><label for="Peace">Peace</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentWantedCategories" value="Freedom" id="Freedom" /><label for="Freedom">Freedom</label></div>
    </li>
</ul>
</div>
<div class="textdiv">Category you don't want to answer:</div>
<div class="textdiv">
<ul>     
	<li>
        <div><input type="radio" name="agentUnwantedCategories" value="None-notwanted" id="None-notwanted" required /><label for="None-notwanted">None not wanted</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentUnwantedCategories" value="Planet" id="Planet" /><label for="Planet">Planet</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentUnwantedCategories" value="World" id="World" /><label for="World">World</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentUnwantedCategories" value="Hygiene" id="Hygiene" /><label for="Hygiene">Hygiene</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentUnwantedCategories" value="Philosophy" id="Philosophy" /><label for="Philosophy">Philosophy</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentUnwantedCategories" value="Psychology" id="Psychology" /><label for="Psychology">Psychology</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentUnwantedCategories" value="Food" id="Food"  /><label for="Food">Food</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentUnwantedCategories" value="Gardening-and-Agriculture" id="Gardening-and-Agriculture" /><label for="Gardening-and-Agriculture">Gardening and Agriculture</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentUnwantedCategories" value="Occupation" id="Occupation" /><label for="Occupation">Occupation</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentUnwantedCategories" value="Flowers" id="Flowers" /><label for="Flowers">Flowers</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentUnwantedCategories" value="Peace" id="Peace" /><label for="Peace">Peace</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentUnwantedCategories" value="Freedom" id="Freedom" /><label for="Freedom">Freedom</label></div>
    </li>
</ul>
</div>
<div class="textdiv">The email to send questions to (Your email): <input name="agentaddress" type="email" id="agentaddress" required /></div>
<div class="textdiv"><input id="submit" type="submit" name="submit" value="Signup" /></div>
</form>
</div>
<div id="signupResult"></div>
        </div>
<script type="text/javascript">
		$("#signup").validate({
		submitHandler: function(form) {
            var form = document.signup;
			var dataString = $(form).serialize();
			$.ajax({
				cache: false,
				type:'POST',
				url:'agentSignupToDatabase.php',
				data: dataString,
				success: function(data) {
				  $('#signupFormDiv').slideUp(1000);
				  $("#signupResult").html(data);
				}
			});
			return false;
			}
});
</script>
    </body>
</html>