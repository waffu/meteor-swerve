<?php
session_start();

// fix this so that it needs database validation
if(isset($_SESSION['username'])){
    header('Location: https://flisk.site/meteorswerve');
}?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>flisk</title>
        <link rel='stylesheet' type='text/css' href='auth\stylesheet.css'>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    
	<body>
	    <!-- start forms -->
	    <div id = 'forms'>
	    <!-- login -->
	    <p id='logintext'>Login <button id='showregister' onclick='showRegister()'> not got an account?</button></p>
		<form action='auth\login.php' method='POST' id='loginform'>
		<div id = 'logininputboxes'>
		<input id = 'loginusername' type='text' name='un' placeholder='username' maxlength='10'><br>
		<input id = 'loginpassword' type='password' name='pw' placeholder='password' maxlength='15'><br><br>
		</div>
		<button id='loginbutton' type="submit">Login</button><br><br>
		<!-- end login -->
		<?
		// php related to showing login error
		
		if ($_SESSION['reset_login_status']=='1'){
		    unset($_SESSION['login_status']);
		    unset($_SESSION['reset_login_status']);}
		    
		if (isset($_SESSION['login_status'])){
		    $_SESSION['reset_login_status'] = '1';
		    echo '<p id ="errortext">Login was unsuccessful.</p>';
		}
		
		?>
		</form>
		<!-- register -->
		<form action='auth\register.php' method='POST' id='registerform'>
		<p id='registertext'>Register</p>
		<div id = 'logininputboxes'>
		<input type='text' name='unreg' placeholder='username' maxlength='10'><br>
		<input type='password' name='pwreg' placeholder='password' maxlength='15'><br>
		<input type='password' name='pwregcheck' placeholder='password' maxlength='15' width="100px"><br>
		</div>
		<div class="g-recaptcha" data-sitekey="6LdkUigUAAAAALXRiLo4ukkHyfH-dPwwuRLN4v3H" data-theme='dark'></div><br>
		<button id='registerbutton' type="submit">Register</button><br><br>
		
		<script>
		    function showRegister(){
		        document.getElementById("registerform").style.display = 'block';
		        
		    }
		</script>
	    <!-- end register -->
		</form>
		
		
		<?
		// this php chunk deals with displaying errors from session variables (registration)
		
		// stops error showing on refresh
		if ($_SESSION['reset_register_status']=='1'){
		    unset($_SESSION['register_status']);
		    unset($_SESSION['reset_register_status']);
		}
		// shows error relating to registration
		if (isset($_SESSION['register_status'])){
		    $_SESSION['reset_register_status'] = '1';
		    $register_status = $_SESSION['register_status'];
		    switch ($register_status) {
                case 'username':
                    echo '<p id ="errortext">Username taken.</p>';
                    break;
                case 'captcha':
                    echo '<p id ="errortext">Captcha incomplete.</p>';
                    break;
                case 'password':
                    echo '<p id ="errortext">Passwords do not match.</p>';
                    break;
                case 'limitnotmet':
                    echo '<p id ="errortext">Minimum character limit for username or password not met.</p>';
                    break;
                case 'limitexceeded':
                    echo '<p id ="errortext">Maximum character limit for username or password exceeded.</p>';
                    break;
                case 'fields':
                    echo '<p id ="errortext">One or more fields are not filled in.</p>';
                    break;
                case 'complete':
                    echo '<p id ="completetext">Registration complete.</p>';
                    break;
        }   // makes register form visible on return from register php
            echo '<script>document.getElementById("registerform").style.display="block";</script>';
		}
	    ?>
	    
	    
		</div>
		<!-- end forms -->
	</body>
</html>