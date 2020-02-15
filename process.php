<?php
require "config/connect.php";
require "config/functions.php";

// Login Verification
if (isset($_POST["Login"])) {

    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    $result = $db->query("SELECT username,password FROM users");

    /* User verification */
    if ($result->num_rows) {
        while ($row = $result->fetch_object()) {
            if ($row->username === $username && password_verify($password, $row->password)) {
                $_SESSION["user"] = $username;
                echo ("Success");
                die();
            } 
        } echo "Failed";
    }

}

//Registration

if (isset($_POST["Register"])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];

    if ($db->query("INSERT INTO users(username,password,email)
    VALUES('$username','$hashed_password','$email') ")) {
        $_SESSION["msg"]="Registered Success";
        redirect_to("index.php");
    } else {
        $_SESSION["msg"] = "Registered Failed";
    }
}

// Add to Cart
if (isset($_POST["Add-to-Cart"])) {

    $product = $_POST["product-title"];
    $price = $_POST["product-price"];
    $desc = $_POST["product-desc"];

    if (isset($_SESSION["user"])) {                      // Confirmation if the user is logged in first before accessing the cart;
        if (isset($_SESSION["cart"])) {                  // Checking if the S_SESSION["cart"] is empty;
            foreach ($_SESSION["cart"] as $index => $value):   
                if (in_array($product, $_SESSION["cart"][$index])) { // Checking if the item is already in the cart;
                    echo "Already Added";
                    die();
                    break;
                }
            endforeach;
            array_push($_SESSION["cart"], array("products" => $product, "price" => $price, "desc" => $desc));
            echo 'Success';

        } else {
            $_SESSION["cart"][0] = array("products" => $product, "price" => $price, "desc" => $desc);
            echo 'Success';
        }
    } else {
        echo "Please Login First";
    }
}

// Removing product to the $_SESSION["cart"].

if (isset($_POST["remove"])) {

    $id = $_POST["index"];
    unset($_SESSION["cart"][$id]);
    echo "success";

}
