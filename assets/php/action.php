<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//$smtp = new SMTP();

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


require_once 'auth.php';
$user = new Auth();


//Handel Register Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $name = $user->test_input($_POST['name']);
    $email = $user->test_input($_POST['email']);
    $password = $user->test_input($_POST['password']);

    $hpass = password_hash($password, PASSWORD_DEFAULT);

    if ($user->user_exist($email)) {
        echo $user->showMessage('warning', 'This E-Mail is already registered!');
    }
     else 
     {
        if ($user->register($name, $email, $hpass)) 
        {
            echo 'register';
            //$_SESSION['user'] = $email;
        
        } 
        else {
            echo $user->showMessage('danger', 'Something went wrong! try again later!');
        }
    }
}


//Handel Resister Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = $user->test_input($_POST['email']);
    $password = $user->test_input($_POST['password']);

    $loggedInUser = $user->login($email);
    if ($loggedInUser != null) {
        if (password_verify($password, $loggedInUser['password'])) {
            if (!empty($_POST['rem'])) {
                setcookie("email", $email, time() + (30 * 24 * 60 * 60), '/');
                setcookie("password", $password, time() + (30 * 24 * 60 * 60), '/');
            } else {
                setcookie("email", "", 1, '/');
                setcookie("password", "", 1, '/');
            }
            echo 'login';
            $_SESSION['user'] = $email;
        } else {
            echo $user->showMessage('danger', 'password is incorrect');
        }
    } else {
        echo $user->showMessage('danger', 'User not found');
    }
}

//Handel Forgot Password Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'forgot') {
    $email = $user->test_input($_POST['email']);
    $user_found = $user->currentUser($email);

    if ($user_found != null) {
        $token = uniqid();
        $token = str_shuffle($token);

        $user->forgot_password($token, $email);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host ='smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "usermanagmentsys@gmail.com";
            $mail->Password = "@Akshat$12822";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('usermanagmentsys@gmail.com','AKSHAT');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $mail->Body = '<h3>Click the below link to reset your password.<br><a href="http://localhost/USER_SYSTEM/reset-password.php?email='.$email.'&token='.$token.'">http://localhost/USER_SYSTEM/reset-password.php?email='.$email.'&token='.$token.'</a><br>Regards<br>AKSHAT!!</h3>';
            if ($mail->send()) {
                echo $user->showMessage('success','We have sent you the reset link in your e-mail ID, please check your e-mail!');
            } else {
                echo $user->showMessage('danger','Something went wrong while sending the e-mail. Please try again later!');
            }
        } catch (Exception $e) {
            echo $user->showMessage('danger', 'Error: ' . $e->getMessage());
        
        }
        
    }
    else{
        echo $user->showMessage('info','This e-mail is not registered!');
    }
}

//Checking user is logged in or not
if(isset($_POST['action']) && $_POST['action'] == 'checkUser'){
    if(!$user->currentUser($_SESSION['user'])){
        echo 'bye';
        unset($_SESSION['user']);
    }
}
