<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }
        .modal-body {
            max-height: calc(100vh - 200px); /* Adjust height */
            overflow-y: auto;
        }
    </style>
</head>
<body>
    
    <?php require('user_header.php');
        $your_id = $_SESSION['login_id'];
        $type = $_SESSION['login_type'];
    ?>

    <div class="w-screen h-screen">

        <div class="flex flex-col">

            <div class="w-full mt-8 ">

                <h1 class="h-8 mb-2 ml-6 font-serif text-3xl font-bold w-fit">Recived Transactions</h1>
               
                <!-- pending payment table -->
                <div class="flex flex-col mt-10 ">
                    
                    <h1 class="ml-10 text-2xl font-medium">Pending Payments</h1>
                    <!-- <hr class="ml-10  mt-1 mb-3 border border-slate-300 w-[70%]"> -->

                    <div class="mt-2 ml-10 mr-10" id="staff_table" style="max-height: 250px; overflow-y: auto;">
                        <table class="justify-between w-full font-sans text-center text-white table-auto table-hover">
                            <thead>
                                <tr class="h-10 text-center bg-slate-800 ">
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Order Quantity</th>
                                    <th>Amount</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                <tr>   
                            </thead>
                            <tbody id="">
                                <?php
                                    require('db_connect.php');                      
                                    $reg_id = $_SESSION['login_id'];

                                    $query = "SELECT * FROM `transaction` WHERE (`payment_status` = 'Pending' OR `payment_status` = 'Process' OR `payment_status` = 'Rejected') AND `provider_id` = '$your_id' AND `provider_type` = '$type' ORDER BY `created` DESC";

                                    $stmt = $conn->prepare($query);

                                    if ($stmt === false) {
                                        die('Prepare error: ' . $conn->error);
                                    }

                                    if (!$stmt->execute()) {
                                        die('Execute error: ' . $stmt->error);
                                    }

                                    // Get result set from the statement
                                    $result = $stmt->get_result();

                                    if($result && $result->num_rows > 0) {
                                        
                                        while($row = $result->fetch_assoc()) {
                                            
                                            ?>
                                                <tr class="h-10 text-center text-black border-b-2 border-slate-300">
                                                    <td id="RP_ID"><?= $row['customer_id']; ?></td>
                                                    <td ><?= $row['customer_name']; ?></td>
                                                    <td ><?= $row['item_name']; ?></td>
                                                    <td ><?= $row['item_quantity'].$row['meassure']; ?></td>
                                                    <td ><?= $row['order_quantity'].$row['meassure']; ?></td>
                                                    <td ><?= "Rs. ".$row['total_amount']; ?></td>
                                                    <td ><?= $row['created']; ?></td>
                                                    <?php 
                                                        $status = $row['payment_status'];
                                                        if($status == 'Pending') {
                                                            ?>
                                                            <td class="items-center justify-center p-1 text-white"><label class="pl-1 pr-1 pb-0.5 bg-yellow-400 rounded-md">Pending</label></td>
                                                            <?php
                                                        }else if($status == 'Process'){
                                                            ?>
                                                            <td class="items-center justify-center p-1 text-white"><label class="pl-2 pr-2 pb-0.5 bg-yellow-500 rounded-md">Process</label></td>
                                                            <?php
                                                        }else if($status == 'Rejected'){
                                                            ?>
                                                            <td class="items-center justify-center p-1 text-white"><label class="pl-1 pr-1 pb-0.5 bg-orange-500 rounded-md">Rejected</label></td>
                                                            <?php
                                                        }
                                                    ?>
                                                </tr>

                                            <?php
                                        }
                                        $stmt->close();

                                    }else{
                                        ?>
                                        <tr>
                                            <td class="h-10 text-center text-black border-b-2 border-slate-300" colspan="9">You have no pending record</td>
                                        </tr>
                                        <?php
                                    }
                                
                                $conn->close();
                        
                                ?>

                            </tbody>

                        </table>
                    </div>


                </div>

                <!-- payments table -->
                <div class="flex flex-col mt-10 ">
                    
                    <h1 class="ml-10 text-2xl font-medium">Completed Payments</h1>

                    <div class="mt-2 ml-10 mr-10" id="staff_table" style="max-height: 300px; overflow-y: auto;">
                        <table class="justify-between w-full font-sans text-center text-white table-auto table-hover">
                            <thead>
                                <tr class="h-10 text-center bg-slate-800 ">
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Order Quantity</th>
                                    <th>Amount</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                <tr>   
                            </thead>
                            <tbody id="">
                                <?php
                                    require('db_connect.php');                      
                                    
                                    $query = "SELECT * FROM `transaction` WHERE (`payment_status` = 'succeeded' OR `payment_status` = 'Completed') AND `provider_id` = '$your_id' AND `provider_type` = '$type' ORDER BY `created` DESC";

                                    // prepare statment
                                    $stmt = $conn->prepare($query);

                                    if ($stmt === false) {
                                        die('Prepare error: ' . $conn->error);
                                    }

                                    if (!$stmt->execute()) {
                                        die('Execute error: ' . $stmt->error);
                                    }

                                    // Get result set from the statement
                                    $result = $stmt->get_result();

                                    if($result && $result->num_rows > 0) {
                                        
                                        while($row = $result->fetch_assoc()) {
                                            
                                            ?>

                                                <tr class="h-10 text-center text-black border-b-2 border-slate-300">
                                                    <td id="RP_ID"><?= $row['customer_id']; ?></td>
                                                    <td ><?= $row['customer_name']; ?></td>
                                                    <td ><?= $row['item_name']; ?></td>
                                                    <td ><?= $row['item_quantity'].$row['meassure']; ?></td>
                                                    <td ><?= $row['order_quantity'].$row['meassure']; ?></td>
                                                    <td ><?= "Rs. ".$row['total_amount']; ?></td>
                                                    <td ><?= $row['created']; ?></td>
                                                    <td class="items-center justify-center p-1 text-white"><label class="pl-1 pr-1 pb-0.5 bg-green-500 rounded-md">Success</label></td>
                                                </tr>

                                            <?php
                                        }
                                        $stmt->close();

                                    }else{
                                        ?>
                                        <tr>
                                            <td class="h-10 text-center text-black border-b-2 border-slate-300" colspan="9">You have not recived order payment record</td>
                                        </tr>
                                        <?php
                                    }
                                
                                $conn->close();
                        
                                ?>

                            </tbody>

                        </table>
                    </div>

                </div>

                <!-- Canceled payments table -->
                <div class="flex flex-col mt-10 ">
                    
                    <h1 class="ml-10 text-2xl font-medium">Canceled payments</h1>

                    <div class="mt-2 ml-10 mr-10" id="staff_table" style="max-height: 250px; overflow-y: auto;">
                        <table class="justify-between w-full font-sans text-center text-white table-auto table-hover">
                            <thead>
                                <tr class="h-10 text-center bg-slate-800 ">
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Order Quantity</th>
                                    <th>Amount</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                <tr>   
                            </thead>
                            <tbody id="">
                                <?php
                                    require('db_connect.php');                      
                                    $customer_id = $_SESSION['login_id'];

                                    $query = "SELECT * FROM `transaction` WHERE `payment_status` = 'Canceled' AND `provider_id` = '$your_id' AND `provider_type` = '$type' ORDER BY `created` DESC";

                                    // prepare statment
                                    $stmt = $conn->prepare($query);

                                    if ($stmt === false) {
                                        die('Prepare error: ' . $conn->error);
                                    }

                                    if (!$stmt->execute()) {
                                        die('Execute error: ' . $stmt->error);
                                    }

                                    // Get result set from the statement
                                    $result = $stmt->get_result();

                                    if($result && $result->num_rows > 0) {
                                        
                                        while($row = $result->fetch_assoc()) {
                                            
                                            ?>

                                                <tr class="h-10 text-center text-black border-b-2 border-slate-300">
                                                    <td id="RP_ID"><?= $row['customer_id']; ?></td>
                                                    <td ><?= $row['customer_name']; ?></td>
                                                    <td ><?= $row['item_name']; ?></td>
                                                    <td ><?= $row['item_quantity'].$row['meassure']; ?></td>
                                                    <td ><?= $row['order_quantity'].$row['meassure']; ?></td>
                                                    <td ><?= "Rs. ".$row['total_amount']; ?></td>
                                                    <td ><?= $row['created']; ?></td>
                                                    <td class="items-center justify-center p-1 text-white"><label class="pl-1 pr-1 pb-0.5 bg-red-500 rounded-md">Canceled</label></td>
                                                </tr>

                                            <?php
                                        }
                                        $stmt->close();

                                    }else{
                                        ?>
                                        <tr>
                                            <td class="h-10 text-center text-black border-b-2 border-slate-300" colspan="9">You have no cancaled record</td>
                                        </tr>
                                        <?php
                                    }
                                
                                $conn->close();
                        
                                ?>

                            </tbody>

                        </table>
                    </div>

                </div>
                
            </div>

        </div>

    </div>

</body>
</html>