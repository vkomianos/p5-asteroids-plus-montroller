<?php

	/*
		Montroller.php is the controller used on the smartphone.
		Sends the orientation data to montroller-receiver.php where the orientation commands are stored into a file.
		Finally js/montroller-reader.js is called by the game to get the commands by montroller-reader.php.
	*/

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
	<title>Asteroids P5 Game</title>
	
	<script src="js/p5.min.js"></script>
	<!--<script src="js/touch-screen-controls.js"></script>-->
	<script src="js/orientation-controller.js"> </script>
	
</head>


<body style="background-image: url('./game-assets/game-controller-3.png');background-repeat: no-repeat;">

<p id="debugging-1" style="background-color:white;"></p>
<p id="debugging-2" style="background-color:white;"></p>
<p id="debugging-3" style="background-color:white;"></p>

	<img src="./game-assets/arrow-left.png" onclick="direction=-1;" style="position:absolute; left:20%; top:5%;"/>
	<img src="./game-assets/arrow-right.png" onclick="direction=1;" style="position:absolute; left:20%; top:85%;"/>
	
	<img src="./game-assets/n-button.png" onclick="newGame();" style="position:absolute; left:50%; top:30%;"/>
	<img src="./game-assets/p-button.png" onclick="gameState='pause-game';"style="position:absolute; left:50%; top:50%;"/>
	
	<img src="./game-assets/button-red.png" onclick="fireMissile();" style="position:absolute; width:30%; left:50%; top:75%;"/>

</body>

<script>

	document.addEventListener('contextmenu', event => event.preventDefault()); // disable context menu that would appear on long taps

	let counter = 0;
	let direction = 0;
	let gameState = "";
	let gameCommand = "";
	
	 // disable context menu that would appear on long taps
	document.body.setAttribute('style', "background-image: url('./game-assets/game-controller-3.png');background-repeat: no-repeat; background-size: "+window.innerWidth+"px "+window.innerHeight+"px");

	setInterval(getOrientationControls, 100); // getOrientationControls updates the direction variable -> gets -1, 0 or 1 for left/none/right
	setInterval(sendData, 100);
	
	function sendData()
	{
		document.getElementById('debugging-3').innerHTML = "Direction: " + direction + " " + counter;
		var xmlhttp = new XMLHttpRequest();
		
			 xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == XMLHttpRequest.DONE) { // XMLHttpRequest.DONE == 4
			   if (xmlhttp.status == 200) {
				   //alert( xmlhttp.responseText);
				   document.getElementById('debugging-1').innerHTML = "Running, response: " + xmlhttp.responseText + ", counter: " + counter; 
			   }
			   else if (xmlhttp.status == 400) {
				  alert('There was an error 400');
			   }
			   else {
				   alert('something else other than 200 was returned');
			   }
			}
			counter++;
		};
		
		/*
		xmlhttp.open("POST", "montroller-receiver.php", true);
		xmlhttp.send("direction="+direction);
		console.log("Sending data: " + direction);
		*/
		xmlhttp.open("GET", "montroller-receiver.php?direction="+direction+"&game-state="+gameState+"&game-command="+gameCommand+"", true);
		//xmlhttp.send("direction="+direction);
		xmlhttp.send();
		direction = 0;
		gameState = "";
		gameCommand = "";
	}


	function newGame()
	{
		gameState = "new-game";
	}
	
	function fireMissile()
	{
		console.log("Tap to fire!!!");
		gameCommand = "fire-missile";
	}
		
</script>

</html>
