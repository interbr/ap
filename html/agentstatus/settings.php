<?php
$timezones = 
array (
  'Please choose' => '',
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
if (isset($_GET['settings']) && (strlen($_GET['settings']) == 1))
 {
 $settingsWanted = strip_tags($_GET['settings']);
}

if (isset($email) && isset($pcode) && isset($settingsWanted)) {

$changeSettingsQuery = $dbhandle->query("SELECT * FROM agents WHERE(email ='".$dbhandle->real_escape_string($email)."' AND pcode='".$dbhandle->real_escape_string($pcode)."')LIMIT 1");
if (mysqli_affected_rows($dbhandle) == 1) {
while($changeSettingsRow = $changeSettingsQuery->fetch_assoc()) {
$getContinent = strip_tags($changeSettingsRow['continent']);
$getWanted = strip_tags($changeSettingsRow['wanted']);
$getUnwanted = strip_tags($changeSettingsRow['unwanted']);
$getAgenttzone = strip_tags($changeSettingsRow['agenttzone']);
$getAgenttime = strip_tags($changeSettingsRow['agenttime']);
};
};
$getCategories = $dbhandle->query("SELECT * FROM question_categories WHERE(status='1')");
$getContinents = $dbhandle->query("SELECT * FROM agents_continents");
};
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<head>
		<title>Help Desk for Earth' Peoples Problems (except IT) - github-project - amored-police</title>
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
		<span class="aptitle"><a href="/">Amored&nbsp;Police</a></span><br /><br />
        <div class="page">
		<div class="textdiv">Help-Desk for Earth' Peoples Problems (except IT)</div>
		<div id="changeFormDiv">
		<form id="change" name="change" class="change" method="post">
<div class="textdiv">Which Continent are you from:</div>
<div class="textdiv">
<ul>
	<?php foreach($getContinents as $getContinentsValue){
		if ($getContinent == $getContinentsValue["continent"]) {
		echo 	"<li>
				<div><input type=\"radio\" name=\"agentContinent\" value=\"".$getContinentsValue["continent"]."\" id=\"".$getContinentsValue["continent"]."\" required checked /><label for=\"".$getContinentsValue["continent"]."\">".$getContinentsValue["continent"]."</label></div>
				</li>"; }
		else{
		echo 	"<li>
				<div><input type=\"radio\" name=\"agentContinent\" value=\"".$getContinentsValue["continent"]."\" id=\"".$getContinentsValue["continent"]."\" required /><label for=\"".$getContinentsValue["continent"]."\">".$getContinentsValue["continent"]."</label></div>
				</li>"; };
		} ?>
</ul>
</div>
<div class="textdiv">Which Timezone are you in:</div>
<div class="textdiv">
	<select name="agenttimezone" class="timezoner" size="1" required >
		<?php foreach($timezones as $tzone => $tzonesave){
		if ($tzonesave == $getAgenttzone ) {
		echo "<option selected value=\"".$tzonesave."\">".$tzone."</option>"; }
		else{
		echo "<option value=\"".$tzonesave."\">".$tzone."</option>"; };
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
	<td><center><input type="checkbox" name="agenttime[]" value="0-6" id="0-6" class="boxchecked" <?php if (strpos($getAgenttime,'0-6') !== false) { echo 'checked="checked"';} ?> /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="6-10" id="6-10" class="boxchecked" <?php if (strpos($getAgenttime,'6-10') !== false) { echo 'checked="checked"';} ?> /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="10-12" id="10-12" class="boxchecked" <?php if (strpos($getAgenttime,'10-12') !== false) { echo 'checked="checked"';} ?>/></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="12-15" id="12-15" class="boxchecked" <?php if (strpos($getAgenttime,'12-15') !== false) { echo 'checked="checked"';} ?> /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="15-18" id="15-18" class="boxchecked" <?php if (strpos($getAgenttime,'15-18') !== false) { echo 'checked="checked"';} ?> /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="18-20" id="18-20" class="boxchecked" <?php if (strpos($getAgenttime,'18-20') !== false) { echo 'checked="checked"';} ?> /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="20-22" id="20-22" class="boxchecked" <?php if (strpos($getAgenttime,'20-22') !== false) { echo 'checked="checked"';} ?> /></center></td>
	<td><center><input type="checkbox" name="agenttime[]" value="22-24" id="22-24" class="boxchecked" <?php if (strpos($getAgenttime,'22-24') !== false) { echo 'checked="checked"';} ?> /></center></td>
	</tr>
	</table>
	</center>
</div>
<div class="textdiv">Category you are good in:</div>
<div class="textdiv">
<ul>
	<?php foreach($getCategories as $getCategoriesWanted){
		if ($getWanted == $getCategoriesWanted["category"]) {
		echo 	"<li>
				<div><input type=\"radio\" name=\"agentWantedCategories\" value=\"".$getCategoriesWanted["category"]."\" id=\"awc-".$getCategoriesWanted["category"]."\" required checked /><label for=\"awc-".$getCategoriesWanted["category"]."\">".$getCategoriesWanted["category"]."</label></div>
				</li>"; }
		else{
		echo 	"<li>
				<div><input type=\"radio\" name=\"agentWantedCategories\" value=\"".$getCategoriesWanted["category"]."\" id=\"awc-".$getCategoriesWanted["category"]."\" required /><label for=\"awc-".$getCategoriesWanted["category"]."\">".$getCategoriesWanted["category"]."</label></div>
				</li>"; };
		} ?>
</ul>
</div>
<div class="textdiv">Category you don't want to answer:</div>
<div class="textdiv">
<ul>     
	<?php foreach($getCategories as $getCategoriesUnwanted){
		if ($getUnwanted == $getCategoriesUnwanted["category"]) {
		echo 	"<li>
				<div><input type=\"radio\" name=\"agentUnwantedCategories\" value=\"".$getCategoriesUnwanted["category"]."\" id=\"anc-".$getCategoriesUnwanted["category"]."\" required checked /><label for=\"anc-".$getCategoriesUnwanted["category"]."\">".$getCategoriesUnwanted["category"]."</label></div>
				</li>"; }
		else{
		echo 	"<li>
				<div><input type=\"radio\" name=\"agentUnwantedCategories\" value=\"".$getCategoriesUnwanted["category"]."\" id=\"anc-".$getCategoriesUnwanted["category"]."\" required /><label for=\"anc-".$getCategoriesUnwanted["category"]."\">".$getCategoriesUnwanted["category"]."</label></div>
				</li>"; };
		} 
		 mysqli_close($dbhandle);
		 ?>
</ul>
</div>
<input type="hidden" name="originalmail" value="<?php  echo $email; ?>" />
<input type="hidden" name="pcode" value="<?php  echo $pcode; ?>" />
<div class="textdiv">The email to send questions to (Your email): <input name="agentaddress" type="email" id="agentaddress" value="<?php echo $email; ?>" required /></div>
<div class="textdiv"><input id="submit" type="submit" name="submit" value="Change" /></div>
</form>
</div>
<div id="changeResult"></div>
        </div>
<script type="text/javascript">
		$( document ).ready(function() {
		$('#change').submit(function() {
		$("#change").validate();
		$.blockUI({ message: '<br />sending ...<br /><br />' });
            var form = document.change;
			var dataString = $(form).serialize();
			$.ajax({
				cache: false,
				type:'POST',
				url:'agentChangeToDatabase.php',
				data: dataString,
				success: function(data) {
				$.unblockUI();
				  $('#changeFormDiv').slideUp(1000);
				  $("#changeResult").html(data);
				}
			});
return false;
});
});
</script>
    </body>
</html>