<div align="center">
	<h2>It works!</h2>
	<?php echo HTML::link('http://github.com/Xocide/miranda','Miranda at GitHub'); ?>
</div>
<p align="center">
	<a href="#" class="clickthis">Click this</a>
</p>
<div class="jquery" align="center" style="display:none;">
	jQuery included!
</div>
<script type="text/javascript">
$(function(){
	$('.clickthis').click(function(){
		$("div.jquery").show("slow");
		$(this).hide();
		return false;
	});
});
</script>
<!-- memory: {memory_useage} -->