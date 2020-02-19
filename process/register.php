<?php
require "../config/connect.php";
require "../config/functions.php";

if (isset($_POST["Register"])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];

    if ($db->query("INSERT INTO users(username,password,email)
    VALUES('$username','$hashed_password','$email') ")) {
        $_SESSION["msg"] = "Registered Success";
        redirect_to("/~yuan/UNOCAFE/index.php");
    } else {
        $_SESSION["msg"] = "Registered Failed";
    }
}


