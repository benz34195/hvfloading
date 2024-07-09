<?php
$servername = "192.168.11.22";
$port = "11310";
$username = "ithvf";
$password = "ithvf-15";
$dbname = "kjmk";

// Create connection
$conn = new mysqli($servername. ':' .$port, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>