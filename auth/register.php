<?php
session_start();
include('dbdefine.php');

// stops error session variable from getting unset on redirect when button already clicked
if ($_SESSION['reset_register_status']=='1'){
    unset($_SESSION['reset_register_status']);
}



// captcha check

if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
    $privatekey = "***REMOVED***";
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $privatekey,
        'response' => $captcha,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    );

    $curlConfig = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $data
    );

    $ch = curl_init();
    curl_setopt_array($ch, $curlConfig);
    $response = curl_exec($ch);
    curl_close($ch);
}

$jsonResponse = json_decode($response);

// General validation - TODO - clean if statements

if ($jsonResponse->success === true) {
    if (isset($_POST['unreg']) and isset($_POST['pwreg']) and isset($_POST['pwregcheck'])) {
        if ($_POST['unreg']!='' and $_POST['pwreg']!='' and $_POST['pwregcheck']!=''){
            $usernamereg = $_POST['unreg'];
            $passwordreg = $_POST['pwreg'];
            $passwordregcheck = $_POST['pwregcheck'];
            if (strlen($usernamereg) <= 10 and strlen($passwordreg) <= 15 and strlen($passwordregcheck) <= 15){
                if (strlen($usernamereg) >= 4 and strlen($passwordreg) >= 8 and strlen($passwordregcheck) >=8){
                    if ($passwordregcheck == $passwordreg){
                
                        // Check if username is registered
                
                        $usernamereg = $db->real_escape_string($usernamereg);
                        $sql = "SELECT * FROM users WHERE username = '$usernamereg'";
                        $result = mysqli_query($db,$sql);
                        if (mysqli_num_rows($result) != 1) {
                
                            // Adds salt to password and generates the hash, inserts this to database
            
                            $salt = mt_rand(000000001,999999999);
                            $phash = hash('sha512',$passwordregcheck . $salt);
                            $sql = "INSERT INTO users (username, phash, salt) VALUES ('$usernamereg', '$phash', '$salt')";
                            mysqli_query($db,$sql);
                            $_SESSION['register_status']='complete';
                            
                        }else{
                            // username taken
                            $_SESSION['register_status']='username';
                        }
                    }else{
                        // passwords do not match
                        $_SESSION['register_status']='password';
                    }
                }else{
                    // username or pass limit not met
                    $_SESSION['register_status']='limitnotmet';
                }
            }else{
                // usernamne or pass limit exceed
                $_SESSION['register_status']='limitexceed';
            }
        }else{
        // fields empty
        $_SESSION['register_status']='fields';
    }
    }
}else{
    // captcha wrong
    $_SESSION['register_status']='captcha';
}
header("Location: https://flisk.site");
?>