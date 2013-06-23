<div class="textdiv"><i>Your Question will have the ID: </i><?php echo $_GET["id"]; ?></div>
<div class="textdiv"><button id="clickWritequestion">Write Question</button></div> <!-- open textarea to enter question -->
<script type="text/javascript">
$(function(){ /* fade textarea in */
		$('#clickWritequestion').click(function(){
		$('#openQuestion').slideUp('slow');
		$('#writeQuestion').load('writequestion.php?id=<?php echo $_GET["id"]; ?>').hide().fadeIn(1000);
		return false; });
		});
</script>