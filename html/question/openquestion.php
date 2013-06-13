<div class="textdiv">Your Question will have the ID: <?php echo $_GET["id"]; ?><br /><br />
<button id="clickWritequestion">Write Question</button></div> <!-- open textarea to enter question -->
<script type="text/javascript">
$(function(){ /* fade textarea in */
		$('#clickWritequestion').click(function(){
		$('#openQuestion').slideUp('slow');
		$('#writeQuestion').load('writequestion.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		return false; });
		});
</script>