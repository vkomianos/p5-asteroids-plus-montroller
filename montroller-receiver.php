<?php

if (isset($_GET["direction"]))
{
	echo $_GET["direction"];
	
	$file = fopen("app.data", "w");
	
	//fwrite($file, $_GET["direction"]);
	if ($_GET["direction"] < 0 )
		//fwrite($file, "left");
		fwrite($file, "direction:left");
	
	if ($_GET["direction"] > 0 )
		//fwrite($file, "right");
		fwrite($file, "direction:right");

	if ($_GET["direction"] == 0 )
		//fwrite($file, "none");
		fwrite($file, "direction:none");
		
	fwrite($file, "&");
	fwrite($file, "game-state:".$_GET['game-state']);
	fwrite($file, "&");
	fwrite($file, "game-command:".$_GET['game-command']);

	fclose($file);
}
?>


