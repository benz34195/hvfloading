<?php
$servername2 = "192.168.10.23";
$username2 = "ik";
$password2 = "1234";
$dbname2 = "kjpr";

// Create connection
$con = new mysqli($servername2, $username2, $password2, $dbname2);


// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


?>