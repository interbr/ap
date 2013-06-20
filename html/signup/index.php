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
		</head>
		<body> 
        <div class="page">
		<div id="signupFormDiv">
		<form id="signup" name="signup" class="signup" method="post">
<div class="textdiv">Why do you want to answer anonymous questions on a regular basis:</div><br />
<textarea name="whyAgent" cols="50" rows="8" maxlength="2000"></textarea>
<br /><br />
<div class="textdiv">Which Continent are you from:</div>
<div class="textdiv">
<ul>
	<li>
        <div><input type="radio" name="agentContinent" value="Dontask" id="Dontask" checked="checked" required /><label for="Dontask">Don't ask</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentContinent" value="Africa" id="Africa" required /><label for="Africa">Africa</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentContinent" value="Asia" id="Asia" required /><label for="Asia">Asia</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentContinent" value="Europe" id="Europe" required /><label for="Europe">Europe</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentContinent" value="Islands" id="Islands" required /><label for="Islands">Islands</label></div>
    </li>
    <li>
        <div><input type="radio" name="agentContinent" value="North-America" id="North-America"  required /><label for="North-America">North-America</label></div>
    </li>
	<li>
        <div><input type="radio" name="agentContinent" value="South-America" id="South-America" required /><label for="South-America">South-America</label></div>
    </li>
</ul>
</div>
<div class="textdiv">Category you are good in:</div>
<div class="textdiv">
<ul>
	<li>
        <div><input type="radio" name="agentWantedCategories" value="All-wanted" id="All-wanted" checked="checked" /><label for="All-wanted">All wanted</label></div>
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
        <div><input type="radio" name="agentUnwantedCategories" value="None-notwanted" id="None-notwanted" checked="checked" /><label for="None-notwanted">None not wanted</label></div>
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
<div class="textdiv">The email to send the question to (Your email): <input name="agentaddress" type="email" id="agentaddress" required /></div>
<div class="textdiv"><input id="submit" type="submit" name="submit" value="Signup" /></div>
</form>
</div>
<div id="signupResult"></div>
        </div>
<script type="text/javascript">
$('#submit').click(function () {
    $("#signup").validate({
        submitHandler: function(form) {
            var form = document.signup;

			var dataString = $(form).serialize();

			$.ajax({
				cache: false,
				type:'POST',
				url:'agentSignupToDatabase.php',
				data: dataString,
				success: function(){
					$('#signupResult').load('signupresult.php').hide().fadeIn(1000);
					$('#signupFormDiv').slideUp(1000);
				}
			});
return false;

        }
    });
});
</script>
    </body>
</html>