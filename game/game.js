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
	ctx.fillText("Click here to start!",330,360);
}

	

class Ship {
	constructor(x, y) {
		this.x = x;
		this.y = y;
		this.moveleft = 0;
		this.moveright = 0;
	}

	stopShip(e) {
		var key = e.keyCode;
		// right
		if(key == 39) {
			this.moveright = 0;
		}

		if(key == 37) {
			this.moveleft = 0;
		}
	}

	// moves ship if moveship vars allow and collision detect is true
	moveShip() {
		// right
		if(this.moveright==1) {
			// collision detect
			if(this.x+50<canvas.width) {
				this.x += 3;
				player.drawShip();
			}
		}
		// left
		if(this.moveleft==1) {
			// collision detect
			if(this.x>0) {
				this.x -= 3;
				player.drawShip();
			}
		}
		player.drawShip();
	}

	// changes vars that are checked to make movement
	moveShipVar(e) {
		var key = e.keyCode;
		// right
		if(key == 39) {
			this.moveright = 1;
		}
		// left
		if(key == 37) {
			this.moveleft = 1;
		}
	}

	// clears screen and draws ship
	drawShip() {
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctx.beginPath();
		ctx.rect(this.x,this.y,50,50);
		ctx.fillStyle = "#FF0000";
		ctx.fill();
		ctx.closePath();
	}
}

player = new Ship(450,750);

// main loop (100 tick rate)
setInterval(function mainLoop() {
	if(gameStarted==1) {
		player.moveShip();
	}
}, 10);