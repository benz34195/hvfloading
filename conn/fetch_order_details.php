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

$conn->close();
?>
