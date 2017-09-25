	var canvas = document.getElementById("gameCanvas");
	var ctx = canvas.getContext("2d");
	var gameStarted = 0;

function startGame() {
	if (gameStarted == 0) {
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		gameStarted = 1;
	}
}
	
	
function canvasPreGame() {
	ctx.font = "40px Arial";
	ctx.fillText("Click here to start!",canvas.width / 3,canvas.height / 2);
}

// main loop (100 tick rate)
setInterval(function mainLoop() {
	if(gameStarted==1) {
		player.moveShip();
	}
}, 10);