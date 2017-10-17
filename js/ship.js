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
				this.x += 4;
			}
		}
		// left
		if(this.moveleft==1) {
			// collision detect
			if(this.x>0) {
				this.x -= 4;
			}
		}
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
		ctx.beginPath();
		ctx.rect(this.x,this.y,50,50);
		ctx.fillStyle = "#FF0000";
		ctx.fill();
		ctx.closePath();
	}
	clearShip() {
		ctx.clearRect(this.x, this.y, 50, 50);
	}
}

// sums in object parameters scale ship to canvas on start
player = new Ship((canvas.width / 2) - 25,canvas.height - 50);