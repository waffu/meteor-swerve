    var canvas = document.getElementById("gameCanvas");
    var ctx = canvas.getContext("2d");
	var gameStarted = 0;
	var x = 450;
	var y = 750;
	var shipmoveright = 0;
	var shipmoveleft = 0;

function startGame() {
    if (gameStarted == 0) {
    	ctx.clearRect(0, 0, canvas.width, canvas.height);
		gameStarted = 1;
		ctx.beginPath();
    	ctx.rect(x, y, 50, 50);
    	ctx.fillStyle = "#FF0000";
    	ctx.fill();
		ctx.closePath();
	}
}
	
	
function canvasPreGame() {
    ctx.font = "40px Arial";
    ctx.fillText("Click here to start!",330,360);
}

function drawShip() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
	ctx.beginPath();
	ctx.rect(x,y,50,50);
    ctx.fillStyle = "#FF0000";
    ctx.fill();
	ctx.closePath();

}

// changes the shipmoving variables
function moveShipVar(e) {
    var key = e.keyCode;
	// right
    if(key == 39) {
    	shipmoveright = 1;
	}
	// left
    if(key == 37) {
    	shipmoveleft = 1;
	}
}

// moves the ship
function moveShip() {
	// right
	if(shipmoveright==1) {
		// collision detect
		if(x+50<canvas.width) {
			x += 3;
			drawShip();
		}
	}
	// left
	if(shipmoveleft==1) {
		// collision detect
		if(x>0) {
			x -= 3;
			drawShip();
		}
	}

}
	

function stopShip(e) {
	var key = e.keyCode;
	// right
	if(key == 39) {
		shipmoveright = 0;
	}

	if(key == 37) {
		shipmoveleft = 0;
	}
}

// main loop (100 tick rate)
setInterval(function mainLoop() {
	moveShip();
}, 10);
