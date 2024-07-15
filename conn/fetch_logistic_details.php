<?php
include 'db.php';
//International
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
}
//Domestic
$sql3 = "SELECT t1.DOno ,Sname , SCNetWeight , DOdate ,TruckNo from do as t1 
left join dotail as t2 on t1.DOno = t2.DOno 
where t1.DOdate = DATE(NOW()) and t1.DOno like '%DO-L%'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    while($row3 = $result3->fetch_assoc()) {
        echo "<tr>";
        if($row3["TruckNo"] != ''){
            echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/deliverd.png' alt=''></div></td>";
        }else{
            echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/inprogress.png' alt=''></div></td>";
        }
        
        echo "<td><h4>" . "พนักงานขับรถ" . " (" . $row3["DOno"] . ") " . "<br><span>" . "บริษัท​เอช​ วี​ ฟิลลา​ จำกัด" . "</span></h4></td>";
        echo "</tr>";
    }
}
//Waste
$sql5 = "SELECT DISTINCT t1.DOno ,Sname, SCNetWeight , DOdate ,TruckNo from do as t1 
left join dotail as t2 on t1.DOno = t2.DOno 
where t1.DOdate = DATE(NOW()) and t1.DOno like '%DO-L%' and t2.count = '-' ";
$result5 = $conn->query($sql5);

if ($result5->num_rows > 0) {
    while($row5 = $result5->fetch_assoc()) {
        echo "<tr>";
        if($row2["TruckNo"] != ''){
            echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/deliverd.png' alt=''></div></td>";
        }else{
            echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/inprogress.png' alt=''></div></td>";
        }
        
        echo "<td><h4>" . "พนักงานขับรถ" . "<br><span>" . "บริษัท​เอช​ วี​ ฟิลลา​ จำกัด" . "</span></h4></td>";
        echo "</tr>";
    }
} 


$conn->close();

include 'db2.php';
//Chemistry
$sql4 = "SELECT DocNo , PODateRec , RDesc , PRAmount , Status
from prtail 
where RID like'CPCM%'
and PODateRec = DATE(NOW())";
$result4 = $con->query($sql4);

if ($result4->num_rows > 0) {
    while($row4 = $result4->fetch_assoc()) {
        echo "<tr>";
        if($row4["Status"] == '13'){
            echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/deliverd.png' alt=''></div></td>";
        }else{
            echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/inprogress.png' alt=''></div></td>";
        }
        
        echo "<td><h4>" . "..." . "<br><span>" . "บริษัท​เอช​ วี​ ฟิลลา​ จำกัด" . "</span></h4></td>";
        echo "</tr>";
    }
} 

$con->close();
?>
