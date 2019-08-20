<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>GIT DEPLOYMENT</title>
</head>
<body>

	<?php
	$commands = array(
		'git pull git@github.com:jenswittmann/zeigwasdumachst.git',
	);
		
	foreach($commands AS $command){
		$tmp = shell_exec($command);	
	?>
	
		$ <?php echo $command; ?>: <?php echo htmlentities(trim($tmp)); ?><br>
		
	<?php
	}
	?>
	
</body>
</html>