<?php


$servername = "127.0.0.1"; //server
$username = "root"; //username
$password = ""; //password
$dbname = "DeliveryDB";  //database

$db = mysqli_connect($servername, $username, $password, $dbname); 
if (!$db) {     
    die("Connection failed: " . mysqli_connect_error());
}

?>