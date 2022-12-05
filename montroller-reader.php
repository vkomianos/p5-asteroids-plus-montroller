<?php


	
	$file = fopen("app.data", "r")or die("Unable to open file!");
	
	echo fread($file, 500);

	fclose($file);

?>


