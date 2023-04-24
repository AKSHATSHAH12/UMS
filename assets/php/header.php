<?php
require_once 'assets/php/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?> AKSHAT-SYSTEM </title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Barlow&family=Maven+Pro:wght@400;500;600;700;800;900&family=Open+Sans&family=PT+Sans&family=Piazzolla:opsz,wght@8..30,200;8..30,300;8..30,400;8..30,900&display=swap');


        * {
            font-style: 'Maven Pro', sans-serif;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#"><i class="fas fa-code fa-lg"></i>&nbsp;&nbsp;AKSHAT-SYSTEM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "home.php")? "active":""; ?>" href="home.php"><i class="fas fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "profile.php")? "active":""; ?>" href="profile.php"><i class="fas fa-user-circle"></i>&nbsp;Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "feedback.php")? "active":""; ?>" href="feedback.php"><i class="fas fa-comment-dots"></i>&nbsp;Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "notification.php")? "active":""; ?>" href="notification.php"><i class="fas fa-bell"></i>&nbsp;Notification&nbsp;<span id="checkNotification"></span></a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                        <i class="fas fa-user-cog"></i>&nbsp;HI!  <?= $fname; ?>
                    </a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item"><i class="fas fa-cog"></i>&nbsp;Setting</a>
                        <a href="assets/php/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>

                    </div>
                </li>
            </ul>
        </div>
    </nav>