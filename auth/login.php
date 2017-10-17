<?php
session_start();
include('dbdefine.php');

// stops error session variable from getting unset on redirect when button already clicked
if ($_SESSION['reset_login_status']=='1'){
    unset($_SESSION['reset_login_status']);
}

if (isset($_POST['un']) and isset($_POST['pw'])) {
	if ($_POST['un']!='' and $_POST['pw']!='') {
	    $username = $_POST['un'];
	    $password = $_POST['pw'];
	    $username = $db->real_escape_string($username);
	    $sql = "SELECT phash,salt FROM users WHERE username = '$username'";
	    $result = mysqli_query($db,$sql);
	    $row = mysqli_fetch_array($result);
	    $dbhash = $row[0];
	    $salt = $row[1];
	    $phash = hash('sha512',$password . $salt);
	    if ($phash == $dbhash){
	        // fix this so the session variable isnt username..
	        $_SESSION['username'] = $username;
	        header("Location: https://flisk.site");
	        
	    }
	}
}
$_SESSION['login_status'] = 'error';
header("Location: https://flisk.site");
?>