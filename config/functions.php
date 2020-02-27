<?php
session_start();


function redirect_to($location){

    header("Location: ".$location);
    die();
}




function userOnly(){
if (strpos($_SERVER["REQUEST_URI"],"/~yuan/UNOCAFE/admin/")) {
    if (!isset($_SESSION["user"])) {
        redirect_to("index.php");

    }
}
}

function adminOnly(){
    if($_SERVER["REQUEST_URI"]==="/~yuan/UNOCAFE/admin/admin.php"){
        if(!isset($_SESSION["admin"])){
            $_SESSION["msg"] = "unauthorized-user";
            redirect_to("../index.php");
             
        }
    }
}

function msg(){
    if(isset($_SESSION["msg"])){

        if($_SESSION["msg"]==="register-success"){
            echo "<script>alert('Registered Sucessfuly')</script>";
        } else if ($_SESSION["msg"] === "register-failed") {
            echo "<script>alert('Register Failed')</script>";
        } else if ($_SESSION["msg"] === "unauthorized-user"){
            echo"<script>alert('Unauthorized User')</script>";
        }

        unset($_SESSION["msg"]);
    }
}
