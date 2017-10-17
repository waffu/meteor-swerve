var canvas = document.getElementById("gameCanvas");
var ctx = canvas.getContext("2d");
var gameStarted = 0;
var gameEnded = 0;

function startGame() {
	if (gameStarted == 0 && gameEnded == 0) {
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		gameStarted = 1;
	}
}
	
	
function canvasPreGame() {
	ctx.font = "40px Arial";
	ctx.fillText("Click here to start!",canvas.width / 3,canvas.height / 2);
}


function mainLoop() {
	if (gameStarted == 1) {

		player.clearShip();
		player.moveShip();
		player.drawShip();

		for (count = 0; count != meteorArray.length; count++) {
			meteorArray[count].clearMeteor();
			meteorArray[count].moveMeteor();
			meteorArray[count].drawMeteor();

			// collision detect in enemy class as its easier
			meteorArray[count].collisionDetect();
			meteorArray[count].resetMeteor();

			scoreIncrement();
		}
	}

window.requestAnimationFrame(mainLoop);
}

// add a meteor every 1.5s
setInterval(function(){ 
	if (gameStarted==1) {
		obj = new Meteor(Math.floor(Math.random() * canvas.width - 50), 0);
		meteorArray.push(obj);
	}
 }, 1500);

mainLoop();
