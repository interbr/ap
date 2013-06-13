<div id="categorizeQuestion">
<br />
<form id="categorizeQuestion" name="categorizeQuestion" class="categorizeQuestion" method="post">
Subject for your question: <input name="subject" type="text" id="subject" /><br /><br />
Categories for your question (up to three):<br /><br />
<ul>        
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="Planet" id="Planet" /><label for="Planet">Planet</label></div>
    </li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="World" id="World" /><label for="World">World</label></div>
    </li>
	<li>
        <div><input type="checkbox" name="questionCategories[]" value="Hygiene" id="Hygiene" /><label for="Hygiene">Hygiene</label></div>
    </li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="Philosophy" id="Philosophy" /><label for="Philosophy">Philosophy</label></div>
    </li>
	<li>
        <div><input type="checkbox" name="questionCategories[]" value="Psychology" id="Psychology" /><label for="Psychology">Psychology</label></div>
    </li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="Food" id="Food"  /><label for="Food">Food</label></div>
    </li>
	<li>
        <div><input type="checkbox" name="questionCategories[]" value="Gardening-and-Agriculture" id="Gardening-and-Agriculture" /><label for="Gardening-and-Agriculture">Gardening and Agriculture</label></div>
    </li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="Occupation" id="Occupation" /><label for="Occupation">Occupation</label></div>
    </li>
	<li>
        <div><input type="checkbox" name="questionCategories[]" value="Flowers" id="Flowers" /><label for="Flowers">Flowers</label></div>
    </li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="Peace" id="Peace" /><label for="Peace">Peace</label></div>
    </li>
	<li>
        <div><input type="checkbox" name="questionCategories[]" value="Freedom" id="Freedom" /><label for="Freedom">Freedom</label></div>
    </li>
	<input type="hidden" name="question-id" value="<?php  echo $_GET["id"]; ?>" />
</ul>
The email to send an answer to: <input name="questionaddress" type="email" id="questionaddress" /><br /><br />
<br />
<input id="submit" type="submit" name="submit" value="Save question" onclick="return submitForm()" />
<button id="clickChangeQuestion">Change Question</button>
</form>
</div>
<script type="text/javascript">
$("input[type=checkbox][name='questionCategories[]']").click(function() {

    var bol = $("input[type=checkbox][name='questionCategories[]']:checked").length >= 3;     
    $("input[type=checkbox][name='questionCategories[]']").not(":checked").attr("disabled",bol);

});
function submitForm() {
var form = document.categorizeQuestion;

var dataString = $(form).serialize();


$.ajax({
    type:'POST',
    url:'categorizeQuestionToDatabase.php',
    data: dataString,
    success: function(){
        $('#savedQuestionPrepare').load('savedquestionpreparetosend.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		$('#categorizeQuestion').slideUp(1000);
		$('#previewQuestionSlide').slideUp(1000);
    }
});
return false;
}
$(function(){ 
		$('#clickChangeQuestion').click(function(){
		$('#writeQuestionTextarea').slideDown(1000);
		$('#previewQuestionInfo').slideUp(1000);
		$('#previewQuestionText').slideUp(1000);
		$('#categorizeQuestion').slideUp(1000);
		return false; });
		});
</script>