<!DOCTYPE html>
<html lang="en">
<?php
include 'conn/db.php';
include 'assets/header.php';
?>
<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
<?php 
include 'assets/navigation.php';
?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <!--
                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.png" alt="">
                </div>
-->
            </div>
            <!-- ========================= Cards ==================== -->

            <iframe class="calendar" src="calendar/index.php" title="Iframe Example"></iframe>

            <!-- =========== Scripts =========  -->
            <script src="assets/js/main.js"></script>

            <!-- ====== ionicons ======= -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>