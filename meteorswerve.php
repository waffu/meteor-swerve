<?php
session_start();
//Validate cookie is legitimate by conferring to database (add later) (stops people making invalid cookies)
if(!isset($_SESSION['username'])){
    header('Location: https://flisk.site');
}
$username = $username=htmlspecialchars(stripslashes($_SESSION['username']));
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $username?> : meteor swerve</title>
        <style>
        #userinfo{position: absolute;}
        canvas { background: #eee; display: block; margin: 0 auto; }
        </style>
    </head>
    <body>
        <div id='userinfo'>
            <a href="auth\logout.php">Logout</a>
        </div>
        
        <font size="20"><center><p id="score">0</p></center></font>
        <canvas id="gameCanvas" width ="1000" height="800" tabindex="1"></canvas>

        <script src="js\game.js"></script>
        <script src="js\ship.js"></script>
        <script src="js\meteor.js"></script>
        <script src="js\listeners.js"></script>
        <script src="js\score.js"></script>

    </body>
</html>

