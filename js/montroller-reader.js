
	
	function readMontrollerReceiver()
	{
		let direction = 0;
		//document.getElementById('debugging-3').innerHTML = "Direction: " + direction + " " + counter;
		let xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function() 
		{
			if (xmlhttp.readyState == XMLHttpRequest.DONE) 
			{ // XMLHttpRequest.DONE == 4
				if (xmlhttp.status == 200) 
				{				 
				   let commands = xmlhttp.responseText.split("&"); //;//.trim();
				   //console.log(commands);
				   //command[0] -> direction
				   if (commands[0].split(':')[1] == "right" )
				   {
						//console.log("Command: " + command);
						//direction = 1;
						localStorage.setItem('direction', 1);
						//console.log("Direction: " + 1);
				   }
				   
				   if (commands[0].split(':')[1] == "left" )
				   {
						//console.log("Command: " + command);
						//direction = -1;
						//console.log("Direction: " + -1);
						localStorage.setItem('direction', -1);
				   }

					if (commands[0].split(':')[1] == "none" )
				   {
						//console.log("Command: " + command);
						//direction = -1;
						//console.log("Direction: " + 0);
						localStorage.setItem('direction', 0);
				   }
				   
				   //commands[1] -> game-state
				   if (commands[1].split(':')[1] == "new-game" )
				   {
						//console.log("Command: " + command);
						//direction = -1;
						//console.log("new game");
						localStorage.setItem('gamestate', "new-game");
				   }
				   else
				   {
						localStorage.setItem('gamestate', "");
				   }
				   
				   //commands[2] -> game-command
				    if (commands[2].split(':')[1].trim() == "fire-missile" )
				   {
						//console.log("Command: " + command);
						//direction = -1;
						//console.log("fire-missile");
						localStorage.setItem('gamecommand', "fire-missile");
				   }
				   else
				   {
					   localStorage.setItem('gamecommand', "");
				   }
				   
				}
				else if (xmlhttp.status == 400) 
				{
					console.log('There was an error 400');
				}
				else 
				{
					console.log('something else other than 200 was returned');
				}
			}
			
		};
		
		
		xmlhttp.open("GET", "montroller-reader.php", true);
		xmlhttp.send();
		//console.log("Direction: " + direction);
		
		//return direction;
		
		
		
	}