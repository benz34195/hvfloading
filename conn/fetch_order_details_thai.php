<?php
include 'db.php';

$sqlTH = "SELECT t1.DOno ,Sname , SCNetWeight , DOdate ,TruckNo from do as t1 
left join dotail as t2 on t1.DOno = t2.DOno 
where t1.DOdate = DATE(NOW()) and t1.DOno like '%DO-L%'";
$resultTH = $conn->query($sqlTH);

if ($resultTH->num_rows > 0) {
    while($row = $resultTH->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["DOno"] . "</td>";
        echo "<td>" . iconv("TIS-620", "UTF-8//IGNORE", $row["Sname"]) . " (" . $row2["t1.DOno"] . ") " . "</td>";
        echo "<td>" . "Thailand" . "</td>";
        echo "<td>" . number_format($row["SCNetWeight"]) . "</td>";
        echo "<td><span class='status " . ($row["TruckNo"] != '' ? "delivered" : "inProgress") . "'>" . ($row["TruckNo"] != '' ? "Delivered" : "In Progress") . "</span></td>";
        echo "</tr>";
    }
} 

$conn->close();
?>
