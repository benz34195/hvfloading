<?php
include 'db.php';

$sql2 = "SELECT DISTINCT t1.DOno ,Sname, SCNetWeight , DOdate ,TruckNo from do as t1 
left join dotail as t2 on t1.DOno = t2.DOno 
where t1.DOdate = DATE(NOW()) and t1.DOno like '%DO-L%' and t2.count = '-' ";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
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
?>
