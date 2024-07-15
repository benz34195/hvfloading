<!DOCTYPE html>
<html lang="en">
<?php
include 'conn/db.php';
include 'assets/navigation.php';
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HVFila | Loading Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- =============== Navigation ================ -->

    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>

        <!-- ======================= Cards ================== -->
        <div class="cardBoxTitle">
            <div class="cardTitle">
                <div>
                    <div class="numbers"><?php echo date("d M Y"); ?></div>   
                </div> 
            </div> 
        </div>

        <div class="cardBox">
            <div class="card">
                <div>
                    <div class='numbers' id='exportInternational'></div>
                    <div class="cardName">Export International</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers" id='exportDomestic'></div>
                    <div class="cardName">Export Domestic</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers" id='ImportChemistry'></div>
                    <div class="cardName">Import Chemistry</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="cart-outline"></ion-icon>
                </div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers" id='SellingWaste'></div>
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
                            <td>Document No</td>
                            <td>Port Name</td>
                            <td>Nationality</td>
                            <td>Weight</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody id="orderDetails"></tbody>   

                        <!-- Data will be loaded here dynamically -->
                        
                        
                    
                </table>
            </div>

            <!-- ================= New Customers ================ -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>Logistic</h2>
                </div>
                <table id="logisticDetails"></table>

                
                    <!-- Data will be loaded here dynamically -->
                
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        function fetchRealtimeData() {
            $.ajax({
                url: 'conn/fetch_data.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#exportInternational').text(data.deliveredINTER + '/' + data.inProcessINTER);
                    $('#exportDomestic').text(data.deliveredTH + '/' + data.inProcessTH);
                    $('#ImportChemistry').text(data.deliveredCM + '/' + data.inProcessCM);
                    $('#SellingWaste').text(data.deliveredSW + '/' + data.inProcessSW);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });

            $.ajax({
                url: 'conn/fetch_order_details.php',
                type: 'GET',
                success: function(data) {
                    console.log(data); // Added for debugging
                    $('#orderDetails').html(data);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });

            $.ajax({
                url: 'conn/fetch_logistic_details.php',
                type: 'GET',
                success: function(data) {
                    $('#logisticDetails').html(data);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });

        
           
        }

        $(document).ready(function() {
            fetchRealtimeData();
            setInterval(fetchRealtimeData, 5000); // Fetch data every 5 seconds
        });
    </script>
</body>
</html>
