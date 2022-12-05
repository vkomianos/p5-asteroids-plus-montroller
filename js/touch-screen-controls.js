let controllerPad;
let controllerLeft;
let controllerRight;
let controllerNew;
let controllerPause;

let leftIsPressed;
let rightIsPressed;

document.addEventListener('contextmenu', event => event.preventDefault()); // disable context menu that would appear on long taps

function setupTouchScreenControls()
{
	//controllerPad = createImg("./game-assets/game-controller-3.png");
	controllerLeft = createImg("./game-assets/arrow-left.png");
	controllerRight = createImg("./game-assets/arrow-right.png");
	controllerNew = createImg("./game-assets/n-button.png");
	controllerPause = createImg("./game-assets/p-button.png");
	
	controllerLeft.touchStarted(touchLeftPressed);
	controllerLeft.mouseReleased(releasedTouchControls);
	
	controllerRight.touchStarted(touchRightPressed);
	controllerRight.mouseReleased(releasedTouchControls);
	
	controllerNew.mousePressed(newGameTouchPressed);
	controllerPause.mousePressed(pauseGameTouchPressed);
}

function drawTouchScreenControls()
{
	controllerPad.position(0,100);
	controllerLeft.position(20,200);
	controllerRight.position(770,200);
	controllerNew.position(280, 200);
	controllerPause.position(540, 200);
}

function releasedTouchControls()
{
	leftIsPressed = false;
	rightIsPressed = false;
}

function touchLeftPressed()
{
	leftIsPressed = true;
	rightIsPressed = false;
}

function touchRightPressed()
{
	leftIsPressed = false;
	rightIsPressed = true;
}

function getTouchDirectionControl()
{
	if (leftIsPressed)
	{
		return -1;
	}
	
	if (rightIsPressed)
	{
		return 1;
	}
}

function newGameTouchPressed()
{
	startGame = true;
	startOnce = true;
	gameOver = false;
}

function pauseGameTouchPressed()
{
	if (startGame && !gameOver && !paused)
					paused = true;
				else if (startGame && !gameOver && paused)
					paused = false;
					
				if (paused)
					spaceship.stopEngineSound();
					
				if (!paused)
					spaceship.startEngineSound();
}