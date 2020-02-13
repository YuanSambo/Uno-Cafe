<?php 
require ("connect.php");
require ("functions.php");



// Login Verification
if(isset($_POST["Login"])){
    
   $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    $result = $db->query("SELECT username,password FROM users");

     /* User verification */        
    if ($result->num_rows) {
        while ($row = $result->fetch_object()) {
            if ($row->username === $username && password_verify($password,$row->password)) {
                $_SESSION["user"]= $username;
                echo("Success");
            } else {
                echo("Failed");
            }
        }
            
        }

    }



//Registration 

/* Registration verification*/

if (isset($_POST["Register"])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];

    if ($db->query("INSERT INTO users(username,password,email) 
    VALUES('$username','$hashed_password','$email') ")) {
        redirect_to('index.php');
    } else {
        redirect_to('index.php');


    }
}



// Add to Cart
if (isset($_POST["Add-to-Cart"])) {

    $product = $_POST["product-title"];
    $price = $_POST["product-price"];
    $desc = $_POST["product-desc"];
if(isset($_SESSION["user"])){
    if (isset($_SESSION["cart"])) {

        foreach($_SESSION["cart"] as $index=>$value):
        if (in_array($product, $_SESSION["cart"][$index])) {
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
  }else{
      echo "Please Login First";
  }
}


//Remove Product to Cart
if(isset($_POST["remove"])){

$id = $_POST["index"];
unset($_SESSION["cart"][$id]);
echo"success";

}



?>