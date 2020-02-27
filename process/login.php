<?php
require "../config/connect.php";
require "../config/functions.php";
 

// Login Verification
if (isset($_POST["Login"])) {

    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    $result = $db->query("SELECT * FROM users");

    /* User verification */
    if ($result->num_rows) {
        while ($row = $result->fetch_object()) {

        if($row->role ==="Customer"){
            if ($row->username === $username && password_verify($password, $row->password)) {
                $_SESSION["user"] = $username;
                $_SESSION["id"] = $row->id;
                echo ("User");
                die();
            }
        }else if ($row->role ==="Administrator"){
                if ($row->username === $username && $row->password === $password ) {
                    $_SESSION["admin"] = $username;
                    $_SESSION["id"] = $row->id;
                    echo ("Admin");
                    die();
                }

        }

        }
        echo "Failed";
    }
}

?>