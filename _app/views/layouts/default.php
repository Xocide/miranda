<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My App</title>
		<?php echo HTML::css_inc_tag(anchor('css/miranda.css')); ?>
		<?php echo HTML::js_inc_tag(anchor('js/jquery.min.js')); ?>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<h1><?php echo HTML::link(anchor(),'Miranda'); ?></h1>
			</div>
			<div id="page" class="content">
<?php echo $output; ?> 
			</div>
			<div id="footer">
				Miranda <?php echo Miranda\VERSION; ?> 
			</div>
		</div>
	</body>
</html>