<?php
include 'db.php';

$sql2 = "SELECT distinct RSName, RSCName , PRMark , t2.DOno FROM packingrickshaw as t1
left join packingrickshawtail as t2 on t2.PRNo =t1.PRNo 
WHERE DATE(BackDate) = DATE(NOW()) AND PRMark in (1,2) and t1.PRNo = t2.PRNo and t1.RevNo = t2.RevNo and t2.NoLine = 1";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        echo "<tr>";
        if($row2["PRMark"] == '2'){
            echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/deliverd.png' alt=''></div></td>";
        }else{
            echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/inprogress.png' alt=''></div></td>";
        }
        echo "<td><h4>" . iconv("TIS-620", "UTF-8//IGNORE", $row2["RSCName"]) . " (" . $row2["DOno"] . ") " ."<br><span>" . iconv("TIS-620", "UTF-8//IGNORE", $row2["RSName"]) . "</span></h4></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='2'>No records found</td></tr>";
}

$conn->close();
?>
