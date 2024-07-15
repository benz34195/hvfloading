<?php
include 'db.php';
include 'db2.php';

$sqlINTER  = "SELECT COUNT(PRStatus) as DeliveredINTER FROM packingrickshaw WHERE DATE(BackDate) = DATE(NOW()) AND PRMark ='2'";
$resultINTER = $conn->query($sqlINTER);
$Delivered = mysqli_fetch_assoc($resultINTER);

$sqlINTER = "SELECT COUNT(PRStatus) as InProcessINTER FROM packingrickshaw WHERE DATE(BackDate) = DATE(NOW()) AND PRMark in (1,2)";
$resultINTER = $conn->query($sqlINTER);
$InProcess = mysqli_fetch_assoc($resultINTER);

$sqlTH1 = "SELECT count(DOno) as DeliveredTH from do where DOdate = DATE(NOW()) and TruckNo is null and DOno like '%DO-L%'";
$resultTH1 = $conn->query($sqlTH1);
$DeliveredTH = mysqli_fetch_assoc($resultTH1);

$sqlTH2 = "SELECT count(DOno) as inProcessTH from do where DOdate = DATE(NOW()) and DOno like '%DO-L%'";
$resultTH2 = $conn->query($sqlTH2);
$InProcessTH = mysqli_fetch_assoc($resultTH2);

$sqlSW1 = "SELECT DISTINCT COUNT(t1.DOno) as deliveredSW from do as t1
left join dotail as t2 on t1.DOno = t2.DOno 
where t1.DOdate = DATE(NOW()) and t1.DOno like '%DO-L%' and t2.count = '-' and TruckNo is not null";
$resultSW1 = $conn->query($sqlSW1);
$DeliveredSW = mysqli_fetch_assoc($resultSW1);

$sqlSW2 = "SELECT DISTINCT COUNT(t1.DOno) as inProcessSW from do as t1
left join dotail as t2 on t1.DOno = t2.DOno 
where t1.DOdate = DATE(NOW()) and t1.DOno like '%DO-L%' and t2.count = '-' ";
$resultSW2 = $conn->query($sqlSW2);
$InProcessSW = mysqli_fetch_assoc($resultSW2);

//Chemistry
$sqlCM = "SELECT 
COUNT(CASE WHEN Status = 13 THEN 1 ELSE NULL END) AS deliveredCM,
COUNT(CASE WHEN Status in (11,13) THEN 1 ELSE NULL END) AS inProcessCM
from prtail
where RID like 'CPCM%'
and PODateRec = DATE(NOW())"; 
$resultCM = $con->query($sqlCM);
$DeliveredCM = mysqli_fetch_assoc($resultCM);


$data = [
    'deliveredINTER' => $Delivered['DeliveredINTER'],
    'inProcessINTER' => $InProcess['InProcessINTER'],
    'deliveredTH' => $DeliveredTH['DeliveredTH'],
    'inProcessTH' => $InProcessTH['inProcessTH'],
    'deliveredSW' => $DeliveredSW['deliveredSW'],
    'inProcessSW' => $InProcessSW['inProcessSW'],
    'deliveredCM' => $DeliveredCM['deliveredCM'],
    'inProcessCM' => $DeliveredCM['inProcessCM']
];

echo json_encode($data);

$conn->close();
$con->close();
?>
