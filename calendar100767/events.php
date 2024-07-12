<?php
$servername = "192.168.11.21";
$username = "it";
$password = "ithvf-24";
$dbname = "calendar_db";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT date, status, COUNT(*) as count FROM events GROUP BY date, status";
$result = $conn->query($sql);

$events = array();
if ($result->num_rows > 0) {
    // ดึงข้อมูลจากผลลัพธ์
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($events);
?>
