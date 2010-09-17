<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My App</title>
		<style>
		body {
			font-family: Verdana, sans-serif;
			font-size: 12px;
			background: #042D3F;
			color: #fff;
			margin: 25px;
			padding: 0;
		}

		#wrapper {
			width: 500px;
			margin: 0 auto;
		}

		#header {
			background: #0A6793;
			padding: 0 5px;
		}
		#header h1 {
			margin: 0;
		}
		
		#page {
			background: #fff;
			color: #000;
		}
		#page h2 {
			margin-top: 0;
			margin-bottom: 4px;
		}
		.content {
			padding: 5px;
		}

		#footer {
			background: #F6F6F6;
			color: #000;
			padding: 4px;
			font-size: 10px;
		}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<h1>Miranda</h1>
			</div>
			<div id="page" class="content">
				<?php echo $output; ?> 
			</div>
			<div id="footer">
				Miranda <?php echo \Miranda\VERSION; ?>
			</div>
		</div>
	</body>
</html>