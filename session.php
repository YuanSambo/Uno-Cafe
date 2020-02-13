<?php

session_start();
// session_unset();

// $_SESSION["cart"][0] =array("Americano","5.00","Lorem hakdog ipsum dela torre");
// array_push($_SESSION["cart"], array("Americano", "5.00", "Lorem hakdog ipsum dela torre"));
// array_push($_SESSION["cart"], array("Americano", "5.00", "Lorem hakdog ipsum dela torre"));







$actual_link = $_SERVER["REQUEST_URI"];
?>


<pre>
<?php
print_r($_SESSION);
echo $actual_link;
?>