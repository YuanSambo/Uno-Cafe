<?php
require "../config/connect.php";
require "../config/functions.php";

//Place Order
if (isset($_POST["order"])) {

    $customer_id = $_SESSION["id"];
    $address = $_POST["address"];
    $total = $_POST["total"];

    $result1 = $db->query("SELECT id FROM orders WHERE customer_id=$customer_id ");

    if ($result1->num_rows < 1) { //Check if theres still an ongoing order.
       $db->query("INSERT INTO orders(customer_id,address,total) VALUES ('$customer_id','$address','$total')");
        $result2 = $db->query("SELECT id FROM orders WHERE customer_id=$customer_id ");
        while ($row = $result2->fetch_object()) {
            echo $row->id;
        }
    } else {
        echo "ongoing";
    }

    echo $db->error;
}




//Order Details

if (isset($_POST["order_details"])) {

    $product = $_POST["product"];
    $qty = $_POST["qty"];
    $price = $_POST["price"];
    $order_id = $_POST["order_id"];

    if ($db->query("INSERT INTO order_details (product,price,quantity,order_id)
    VALUES ('$product','$price','$qty','$order_id') ")) {
        echo "Success";
    } else
        echo $db->error;
}
