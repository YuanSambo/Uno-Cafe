<?php
require "../config/connect.php";
require "../config/functions.php";

if (isset($_POST["remove"])) {
    $id = $_POST["index"];
    unset($_SESSION["cart"][$id]);
    echo "success";
}

?>