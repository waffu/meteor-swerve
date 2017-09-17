<?php
session_start();
//Validate cookie is legitimate by conferring to database (add later) (stops people making invalid cookies)
if(!isset($_SESSION['username'])){
    header('Location: https://flisk.site');
}
$username = strtolower($_SESSION['username']);
$ip=$_SERVER['REMOTE_ADDR'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>landing</title>
    </head>
    <body>
        <? 
        $landingtext = "Welcome $username"."<br/>"."IP: $ip";
        echo $landingtext;
        ?>
        <br><a href="logout.php">Logout</a>
    </body>
</html>

