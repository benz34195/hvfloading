<?php
// fetch_data.php
$data = "Current Server Time: " . date('H:i:s');


include '../conn/db.php';

$sql3 = "SELECT COUNT(PRStatus) as Delivered FROM packingrickshaw
WHERE DATE(ToFactoryDate) = DATE(NOW()) AND PRStatus ='5'"; // Adjust table name accordingly
$result3 = $conn->query($sql3);
$Delivered = mysqli_fetch_assoc($result3);

$sql4 = "SELECT COUNT(PRStatus) as InProcess FROM packingrickshaw
WHERE DATE(ToFactoryDate) = DATE(NOW())"; // Adjust table name accordingly
$result4 = $conn->query($sql4);
$InProcess = mysqli_fetch_assoc($result4);


$Delivered=$Delivered['Delivered'];
$InProcess=8;
echo $Delivered."/".$InProcess;
?>
