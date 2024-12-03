<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="select-none">

    <div class="fixed top-4 right-2">
        
        <?php
            include 'db_connect.php';

                $username = $_SESSION['login_user'];
                $usertype = $_SESSION['login_type'];
                $user_id = $_SESSION['login_id'];
                
                ?>
                <button id="menubar_btn" class="relative flex items-center justify-center rounded-full bottom-2 h-fit w-fit bg-slate-200">
                    <?php
                        $sql = "SELECT images FROM $usertype WHERE username = '$username'";
                        $query_run = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($query_run);
                        $image = $row['images'];

                        if($image != NULL) {
                            ?>
                            <img src="images/user/<?php echo $image; ?>" class="w-12 h-12 border-2 rounded-full border-slate-300" alt="image">
                            <?php

                        }else{
                            ?>
                            <h1 class=" flex justify-center font-serif items-center text-[#73F80B] text-xl font-bold w-8 h-8 text-center "><?php echo strtoupper($username[0]); ?></h1>
                        <?php
                        } 
                    ?>  
                </button>
            <?php
        ?>
        
    </div>

    <!--user menu bar -->
    <div id="menubar" class="fixed inset-0 z-[10000]" style="display: none;"> 
        <div class="p-4 rounded-xl fixed border shadow-2xl border-slate-300 bg-[#fefefe] text-black top-12 right-3 w-[250px]">

            <!-- Modal Body -->
            <div class="flex flex-col items-center justify-center">
                <?php
                    if($image != NULL) {
                        ?>
                        <img src="images/user/<?php echo $image; ?>" alt="image" class="w-24 h-24 border-2 rounded-full border-slate-300">
                        <?php
                    }else{
                        ?>
                        <h1 class=" flex justify-center items-center font-serif bg-slate-200 text-[#73F80B] rounded-full text-5xl font-bold w-24 h-24 text-center "><?php echo strtoupper($username[0]); ?></h1>
                    <?php
                    } 
                ?>
            </div>
            <div class="flex flex-col mt-5">
                <label class="pl-2">Type : <?php echo ucfirst($usertype); ?></label>
                <label class="pl-2">Username : <?php echo $username; ?></label>
            </div>

            <div class="flex flex-col gap-0.5 mt-5 border-t-2 border-slate-300">
                <a href="index.php" class="pt-1 pb-1 pl-2 mt-1 rounded-md hover:bg-blue-300">Home</a>
                <?php
                    if($usertype == 'supplier') {
                        ?>
                        <a href="supplier_dashboard.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Profile</a>
                        <a href="own_rating.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Rating</a>
                        <a href="product_manage.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Products Manage</a>
                        <a href="customer_order.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Customer Orders</a>
                        <a href="order_history.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Your Orders</a>
                        <a href="recived_payment.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Recived Transactions</a>
                        <a href="payment_dashboard.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Paid Transactions</a>
                        <?php
                    }else if($usertype == 'farmer') {
                        ?>
                        <a href="farmer_dashboard.php" class="pl-2 rounded-md hover:bg-blue-300">Profile</a>
                        <a href="own_rating.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Rating</a>
                        <a href="vegetable_manage.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Products Manage</a>
                        <a href="customer_order.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Customer Orders</a>
                        <a href="order_history.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Your Orders</a>
                        <a href="recived_payment.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Recived Transactions</a>
                        <a href="payment_dashboard.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Paid Transactions</a>
                        <?php
                    }else{
                        ?>
                        <a href="customer_dashboard.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Profile</a>
                        <a href="order_history.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Order History</a>
                        <a href="payment_dashboard.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Payment Records</a>
                        <?php
                    }
                    ?>
                    <a href="login.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Switch Account</a>   
                    <a href="logout.php" class="pt-1 pb-1 pl-2 rounded-md hover:bg-blue-300">Log Out</a>
            </div>

        </div>
    </div>

    <!-- user menu bar popup and hide -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            <?php 
                if(isset($_SESSION['login_user'])) {
                    ?>

                    const modal = document.getElementById("menubar"); // The modal element
                    const show_btn =document.getElementById("menubar_btn");

                    show_btn.onclick = function() {
                        if(modal.style.display === "block") {
                            modal.style.display = "none";
                        }else {
                            modal.style.display = "block";
                        }
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                <?php
                }
            ?>
        });
    </script>


</body>
</html>