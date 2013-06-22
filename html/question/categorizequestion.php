<div class="textdiv" id="categorizeQuestionDiv">
<br />
<form id="categorizeQuestion" name="categorizeQuestion" class="categorizeQuestion" method="post">
Subject for your question: <input name="subject" type="text" id="subject" /><br /><br />
Categories for your question (up to three):<br /><br />
<ul>
	<li>
		<div><input type="radio" name="questionCategories[]" value="none" id="none" checked="checked" /><label for="none">None</label></div>
	</li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="Planet" id="Planet" class="boxchecked" /><label for="Planet">Planet</label></div>
    </li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="World" id="World" class="boxchecked" /><label for="World">World</label></div>
    </li>
	<li>
        <div><input type="checkbox" name="questionCategories[]" value="Hygiene" id="Hygiene" class="boxchecked" /><label for="Hygiene">Hygiene</label></div>
    </li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="Philosophy" id="Philosophy" class="boxchecked" /><label for="Philosophy">Philosophy</label></div>
    </li>
	<li>
        <div><input type="checkbox" name="questionCategories[]" value="Psychology" id="Psychology" class="boxchecked" /><label for="Psychology">Psychology</label></div>
    </li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="Food" id="Food" class="boxchecked" /><label for="Food">Food</label></div>
    </li>
	<li>
        <div><input type="checkbox" name="questionCategories[]" value="Gardening-and-Agriculture" id="Gardening-and-Agriculture" class="boxchecked" /><label for="Gardening-and-Agriculture">Gardening and Agriculture</label></div>
    </li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="Occupation" id="Occupation" class="boxchecked" /><label for="Occupation">Occupation</label></div>
    </li>
	<li>
        <div><input type="checkbox" name="questionCategories[]" value="Flowers" id="Flowers" class="boxchecked" /><label for="Flowers">Flowers</label></div>
    </li>
    <li>
        <div><input type="checkbox" name="questionCategories[]" value="Peace" id="Peace" class="boxchecked" /><label for="Peace">Peace</label></div>
    </li>
	<li>
        <div><input type="checkbox" name="questionCategories[]" value="Freedom" id="Freedom" class="boxchecked" /><label for="Freedom">Freedom</label></div>
    </li>
	<input type="hidden" name="question-id" value="<?php  echo $_GET["id"]; ?>" />
</ul>
<br />
The email to send an answer to: <input name="questionaddress" type="email" id="questionaddress" required /><br />
<br />
<input id="submit" type="submit" name="submit" value="Save question" />
<button id="clickChangeQuestion">Change Question</button>
</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
   $('.boxchecked').click(function () {
   var x = $('.boxchecked:checked').length;
      if (x > 0){
      $('#none').removeAttr("checked");
      }
   });

 $('body').click(function () {
    var x = $('.boxchecked:checked').length;
     if (x == 0){
     $('#none').attr("checked","checked");
     }
   });
   $('body').click(function () {
    var x = $('#none:checked').length;
     if (x > 0){
     $("input[type=checkbox][name='questionCategories[]']").removeAttr("checked").removeAttr("disabled");
     }
   });

});
$("input[type=checkbox][name='questionCategories[]']").click(function() {

    var bol = $("input[type=checkbox][name='questionCategories[]']:checked").length >= 3;     
    $("input[type=checkbox][name='questionCategories[]']").not(":checked").attr("disabled",bol);

});
$('#submit').click(function () {
    $("#categorizeQuestion").validate({
        submitHandler: function(form) {
            var form = document.categorizeQuestion;
			var dataString = $(form).serialize();
			$.ajax({
			cache: false,
			type:'POST',
			url:'categorizeQuestionToDatabase.php',
			data: dataString,
			success: function(){
				$('#savedQuestionPrepare').load('savedquestionpreparetoverify.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
				$('#categorizeQuestionDiv').slideUp(1000);
				$('#previewQuestionSlide').slideUp(1000);
			}
		});
return false;

        }
    });
});
$(function(){ 
		$('#clickChangeQuestion').click(function(){
		$('#writeQuestionTextarea').slideDown(1000);
		$('#buttonCategorizeQuestion_2').slideDown(1000);
		$('#previewQuestionInfo').slideUp(1000);
		$('#previewQuestionText').slideUp(1000);
		$('#categorizeQuestionDiv').slideUp(1000);
		return false; });
		});
</script>