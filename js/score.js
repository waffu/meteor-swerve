// increments score, add accelleration like value later
var score = 0;
function scoreIncrement() {
	document.getElementById('score').innerHTML = '';
	score += 1;
	document.getElementById('score').innerHTML = score;
}