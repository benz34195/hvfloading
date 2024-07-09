<!DOCTYPE html>
<html lang="en">
<?php
include 'conn/db.php';

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HVFila | Loading Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        
                        <span class="title">HVFila</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </span>
                        <span class="title">Calendar</span>
                    </a>
                </li>
<!--
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
                -->
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.png" alt="">
                </div>
            </div>
            <?php
            
                            $sql3 = "SELECT COUNT(PRStatus) as Delivered FROM packingrickshaw
                            WHERE DATE(ToFactoryDate) = DATE(NOW()) AND PRStatus ='5'"; // Adjust table name accordingly
                            $result3 = $conn->query($sql3);
                            $Delivered = mysqli_fetch_assoc($result3);

                            $sql4 = "SELECT COUNT(PRStatus) as InProcess FROM packingrickshaw
                            WHERE DATE(ToFactoryDate) = DATE(NOW())"; // Adjust table name accordingly
                            $result4 = $conn->query($sql4);
                            $InProcess = mysqli_fetch_assoc($result4);


                            ?>
            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <?php echo "<div class='numbers'>". $Delivered['Delivered'] ."/". $InProcess['InProcess'] ."</div>" ?>
                        <div class="cardName">Export International</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0/0</div>
                        <div class="cardName">Export Domestic</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0/0</div>
                        <div class="cardName">Import Chemistry</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0/0</div>
                        <div class="cardName">Selling Waste</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Loading Orders</h2>
                        <a href="#" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Port Name</td>
                                <td>Amount</td>
                                <td>Date</td>
                                <td>Status</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            // Default sorting by ID ascending
                            
                            $sql = "SELECT PortName,SCTotNetWeight,ToFactoryDate,PRStatus FROM packingrickshaw
                            WHERE DATE(ToFactoryDate) = DATE(NOW())"; // Adjust table name accordingly
                            $result = $conn->query($sql);
    
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr data-PortName='" . $row["PortName"] . "' data-SCTotNetWeight='" . $row["SCTotNetWeight"] . "' data-ToFactoryDate='" . $row["ToFactoryDate"] . "' data-PRStatus='" . $row["PRStatus"] . "' >";
                                    echo "<td>" . $row["PortName"] . "</td>";
                                    echo "<td>" . number_format($row["SCTotNetWeight"]) . "</td>";
                                    echo "<td>" . $row["ToFactoryDate"]. "</td>";
                                    if($row["PRStatus"]=='5'){
                                        echo "<td>".'<span class="status delivered">Delivered</span>'."</td>";
                                    }else{
                                        echo "<td>".'<span class="status inProgress">In Progress</span>'."</td>";
                                    }
                                    //echo "<td>" . $row["PRStatus"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No records found</td></tr>";
                            }
    
                            //$conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Logistic</h2>
                    </div>

                    <table>
                        <?php
                            $sql2 = "SELECT RSName ,RSCName FROM packingrickshaw
                            WHERE DATE(ToFactoryDate) = DATE(NOW())"; // Adjust table name accordingly
                            $result2 = $conn->query($sql2);

                            if ($result2->num_rows > 0) {
                                while($row2 = $result2->fetch_assoc()) {
                                    echo "<tr data-RSName='" . $row2["RSName"] . "' data-RSCName='" . $row2["RSCName"] . "' >";
                                    echo "<td width='60px'>"."<div class='imgBx'><img src='assets/imgs/logistic.png' alt=''></div>" . "</td>" 
                                    . "<td><h4>" . $row2["RSCName"] . "<br><span>" . $row2["RSName"] . "</span></h4></td>";
                                   
                                   
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No records found</td></tr>";
                            }
    
                            $conn->close();
                            ?>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>