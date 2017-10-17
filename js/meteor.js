class Meteor {
	constructor(x, y) {
		this.x = x;
		this.y = y;
	}

	drawMeteor() {
		ctx.beginPath();
		ctx.rect(this.x,this.y,50,50);
		ctx.fillStyle = "#B25541";
		ctx.fill();
		ctx.closePath();
	}

	moveMeteor() {
		this.y += 5;
	}

	clearMeteor() {
		ctx.clearRect(this.x, this.y, 50, 50);
	}

	// to add
	collisionDetect() {
		if (this.y + 50 >= player.y && this.y - 50 <= player.y ) {
			if (this.x >= player.x - 50 && this.x <= player.x + 50) {
				gameStarted = 0;
				gameEnded = 1;
			}
		}
	}

	resetMeteor() {
		if (this.y > canvas.height) {
			this.y = 0
			this.x = Math.floor(Math.random() * canvas.width - 50)
		}
	}
}

// initial meteor setup
// start with 1

var meteorArray = [];
obj = new Meteor(Math.floor(Math.random() * canvas.width - 50), 0);
meteorArray.push(obj);
