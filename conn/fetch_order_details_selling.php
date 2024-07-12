<?php
include 'db.php';

$sqlSW = "SELECT DISTINCT t1.DOno ,Sname, SCNetWeight , DOdate ,TruckNo from do as t1 
left join dotail as t2 on t1.DOno = t2.DOno 
where t1.DOdate = DATE(NOW()) and t1.DOno like '%DO-L%' and t2.count = '-' ";
$resultsw = $conn->query($sqlSW);

if ($resultsw->num_rows > 0) {
    while($rowSW = $resultsw->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowSW["DOno"] . "</td>";
        echo "<td>" . iconv("TIS-620", "UTF-8//IGNORE", $rowSW["Sname"]) . "</td>";
        echo "<td>" . "Thailand" . "</td>";
        echo "<td>" . number_format($rowSW["SCNetWeight"]) . "</td>";
        echo "<td><span class='status " . ($rowSW["TruckNo"] != '' ? "delivered" : "inProgress") . "'>" . ($rowSW["TruckNo"] != '' ? "Delivered" : "In Progress") . "</span></td>";
        echo "</tr>";
    }
} 

$conn->close();
?>
