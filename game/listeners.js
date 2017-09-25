// event listeners
document.getElementById("gameCanvas").addEventListener("click", startGame);
document.getElementById("gameCanvas").addEventListener("keydown", function(e) { player.moveShipVar(e); });
document.getElementById("gameCanvas").addEventListener("keyup", function(e) { player.stopShip(e); });