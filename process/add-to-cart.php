<?php
require "../config/connect.php";
require "../config/functions.php";
 

// Add to Cart
if (isset($_POST["Add-to-Cart"])) {

$product = $_POST["product-title"];
$price = $_POST["product-price"];
$desc = $_POST["product-desc"];
$img = $_POST["product-img"];

if (isset($_SESSION["user"])) { // Confirmation if the user is logged in first before accessing the cart;
if (isset($_SESSION["cart"])) { // Checking if the S_SESSION["cart"] is empty;
foreach ($_SESSION["cart"] as $index => $value):
if (in_array($product, $_SESSION["cart"][$index])) { // Checking if the item is already in the cart;
echo "Already Added";
die();
break;
}
endforeach;
array_push($_SESSION["cart"], array("products" => $product, "price" => $price, "desc" => $desc ,"img" => $img));
echo 'Success';

} else {
$_SESSION["cart"][0] = array("products" => $product, "price" => $price, "desc" => $desc,"img" => $img);
echo 'Success';
}
} else {
echo "Please Login First";
}
}

?>