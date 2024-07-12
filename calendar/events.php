<?php
require_once '../conn/db.php';

date_default_timezone_set('Asia/Bangkok');

$start = $_GET['start'];
$end = $_GET['end'];


// $sql = " select 
// t1.PRNo ,
// t1.RevNo ,
//     CASE 
//         WHEN t1.RevNo IS NOT NULL AND t1.RevNo != '' THEN CONCAT(t1.PRNo, '-', t1.RevNo)
//         ELSE t1.PRNo
//     END AS CombinedPRNo,
// t1.PRDate ,
// t1.ReceiveDate as 'วันรับตู้เปล่า',
// t1.ToFactoryDate as 'ตู้เข้าโรงงาน',
// t1.BackDate as 'วันคืนตู้',
// t1.ClosingDate as 'deadline',
// t1.ETDDate,
// t1.ETADate,
// t2.SCno ,
// t2.DOno ,
// t2.SCCustomerName 
// from packingrickshaw as t1
// left join packingrickshawtail as t2 on t1.PRNo = t2.PRNo and t1.RevNo = t2.RevNo and t2.NoLine = 1
// where t1.PRDate between '$start' and '$end'
// group by t1.RevNo ,t1.PRNo  ";
// $sql = "select 
// t1.PRStatus ,
// t3.PRStatusDesc ,
//  COUNT(CASE WHEN t1.PRStatus = 5 THEN 1 END) AS InProgress,
//  COUNT(CASE WHEN t1.PRStatus != 5 THEN 1 END) AS Delivered,
//  t1.ClosingDate,
//   t1.ETDDate
// from packingrickshaw as t1
// left join packingrickshawtail as t2 on t1.PRNo = t2.PRNo and t1.RevNo = t2.RevNo and t2.NoLine = 1
// inner join packingrickshawstatus as t3 on t1.PRStatus = t3.PRStatus 
// where t1.ClosingDate between '$start' and '$end'
// group by t1.PRStatus ,t1.ClosingDate";
$sql = "select 
t3.PRStatusDesc ,
t1.PRStatus ,
CASE 
    WHEN t1.PRStatus = 5 THEN 'Delivered' 
    ELSE 'InProgress'
 END as SumDelivered,
 COUNT(
 CASE 
	 WHEN t1.PRStatus = 5 THEN 1 
	 ELSE 0
 END) AS Total,
 t1.ClosingDate,
 t1.ETDDate
from packingrickshaw as t1
left join packingrickshawtail as t2 on t1.PRNo = t2.PRNo and t1.RevNo = t2.RevNo and t2.NoLine = 1
inner join packingrickshawstatus as t3 on t1.PRStatus = t3.PRStatus 
where t1.ClosingDate between '$start' and '$end'
and t1.PRStatus in (4,5)
group by SumDelivered,t1.ClosingDate";
// echo $sql;
// exit();

$result = $conn->query($sql);




$events = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['SumDelivered'] == 'Delivered') {
            $eventColor = '#4CAF50';
            $textColor = '#ffff';
        } else {
            $eventColor = '#FF9800';
            $textColor = '#ffff';
        }
        $events[] = array(
            'id' => $row['ClosingDate'],
            'resourceId' => $row['ClosingDate'],
            'title' =>  $row['SumDelivered'] . ' (' . $row['Total'] . ')',
            // 'title' => iconv("TIS-620", "UTF-8//IGNORE", $row['PRStatusDesc']),
            'start' => $row['ClosingDate'],
            // 'end' => $row['ETDDate'],
            'eventColor' => $eventColor,
            'textColor' => $textColor
        );
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($events);
