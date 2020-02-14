<?php 
require "config/connect.php";
include "config/functions.php";
userOnly();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Uno Cafe</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
</head>
<body>
    <!----NavigationBar---->
    <section id="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#"><img src="img/unocafelogo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">MENU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">CONTACT US</a>
                    </li>
                    <?php if (isset($_SESSION["user"])) {
                        echo ('<li class="nav-item">
                          <a class="nav-link" href="cart.php">CART</a> 
                          </li>');
                        echo ('<li class="nav-item">
                          <a class="nav-link" href="logout.php">LOG OUT</a> 
                          </li>');
                    } else {
                        echo ('<li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLoginForm">LOG IN</a>
                    </li>');
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </section>

    <!-- LOG IN FORM -->
    <form id="login-form" action="#">
        <div class="modal fade pt-5" id="modalLoginForm" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">SIGN IN</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="defaultForm-username"> Username</label>
                            <input type="text" id="defaultForm-username" name="login-username" class="form-control validate" required>
                        </div>

                        <div class="md-form mb-4">
                            <i class="fas fa-lock prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="defaultForm-pass"> Password</label>
                            <input type="password" id="defaultForm-pass" name="login-password" class="form-control validate" required>
                        </div>
                    </div>
                    <div class="modal-button d-flex justify-content-center">
                        <button class="btn btn-default" type="submit" name="Login" id="login-btn">Login</button>
                        <input type="hidden" name="Login" value="Login">
                    </div>
                    <p>Forgot Password? </p>
    </form>
    <div class="modal-footer d-flex justify-content-center">
        <p>Not Registered?</p>
        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modalRegisterForm">Register</button>
    </div>
    </div>
    </div>
    </div>

    <!----REGISTRATION FORM-->
    <form id="register-form" action="#">
        <div class="modal fade pt-5" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">SIGN UP</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <i class="fas fa-user prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="orangeForm-name"> Username</label>
                            <input type="text" id="orangeForm-name" name="username" class="form-control validate" required>
                        </div>
                        <div class="md-form mb-5">
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="orangeForm-email"> E-mail</label>
                            <input type="email" id="orangeForm-email" name="email" class="form-control validate" required>
                        </div>

                        <div class="md-form mb-4">
                            <i class="fas fa-lock prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="orangeForm-pass" required> Password</label>
                            <input type="password" id="orangeForm-pass" name="password" class="form-control validate" required>
                        </div>

                        <div class="md-form mb-4">
                            <i class="fas fa-lock prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="orangeForm-pass" required> Confirm
                                Password</label>
                            <input type="password" id="orangeForm-pass" name="cpassword" class="form-control validate" required>
                        </div>
                    </div>
                    <div class="modal-button d-flex justify-content-center">
                        <button class="btn btn-deep-orange" name="Register" type="submit">Sign up</button>
                    </div>
    </form>
    <div class="modal-footer d-flex justify-content-center">
        <p>Already Registered?</p>
        <button class="btn btn-deep-orange" data-toggle="modal" class="close" data-dismiss="modal">Log In</button>
    </div>
    </div>
    </div>
    </div>