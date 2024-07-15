<?php
include 'db.php';

$sqlINTER = "SELECT PortName,Nationality, SCTotNetWeight, BackDate, PRMark ,DOno from packingrickshaw as t1 
left join packingrickshawtail as t2 on t1.PRNo = t2.PRNo and t1.RevNo = t2.RevNo and t2.NoLine = 1 where DATE(BackDate) = DATE(NOW()) AND PRMark in (1,2)";
$resultINTER = $conn->query($sqlINTER);


if ($resultINTER->num_rows > 0) {
    while($row = $resultINTER->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["DOno"] . "</td>";
        echo "<td>" . $row["PortName"] . "</td>";
        echo "<td>" . $row["Nationality"] . "</td>";
        echo "<td>" . number_format($row["SCTotNetWeight"]) . "</td>";
        echo "<td><span class='status " . ($row["PRMark"] == '2' ? "delivered" : "inProgress") . "'>" . ($row["PRMark"] == '2' ? "Delivered" : "In Progress") . "</span></td>";
        echo "</tr>";
    }
} 

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

include 'db2.php';

$sqlSW = "SELECT DISTINCT DocNo , PODateRec , RDesc , PRAmount , Status
from prtail 
where RID like'CPCM%'
and PODateRec = DATE(NOW())";
$resultsw = $con->query($sqlSW);

if ($resultsw->num_rows > 0) {
    while($rowSW = $resultsw->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowSW["DocNo"] . "</td>";
        echo "<td>" . "บริษัท​เอช​ วี​ ฟิลลา​ จำกัด" . "</td>";
        echo "<td>" . "Thailand" . "</td>";
        echo "<td>" . number_format($rowSW["PRAmount"]) . "</td>";
        echo "<td><span class='status " . ($rowSW["Status"] == '13' ? "delivered" : "inProgress") . "'>" . ($rowSW["Status"] = '13' ? "Delivered" : "In Progress") . "</span></td>";
        echo "</tr>";
    }
} 

$con->close();
?>
