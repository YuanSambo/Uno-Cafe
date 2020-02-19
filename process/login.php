<?php
require "../config/connect.php";
require "../config/functions.php";
 

// Login Verification
if (isset($_POST["Login"])) {

    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    $result = $db->query("SELECT id,username,password FROM users");

    /* User verification */
    if ($result->num_rows) {
        while ($row = $result->fetch_object()) {
            if ($row->username === $username && password_verify($password, $row->password)) {
                $_SESSION["user"] = $username;
                $_SESSION["id"] = $row->id;
                echo ("Success");
                die();
            }
        }
        echo "Failed";
    }
}

?>