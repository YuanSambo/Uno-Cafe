<?php

$host = "localhost";
$username = "root";
$password = "^345Sambo";
$dbname = "unocafe";
$db = new mysqli($host,$username,$password,$dbname);

if($db->connect_errno){
   die("Connection Failed");
}

?>