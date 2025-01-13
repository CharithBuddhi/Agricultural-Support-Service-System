<?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['login_admin_user'])){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Farmer Info</title>
    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }  
        .modal-body {
            max-height: calc(100vh - 200px); /* Adjust height */
            overflow-y: auto;
        }
            /* Active button style */
        .active {
            background-color: #64748b; /* Highlighted color */
            color: white;            /* Optional: Change text color */
        }
    </style>
</head>
<body class="bg-[#305dc7] text-white">
    
    <div class="w-screen h-screen">
        <div class="flex w-full h-full">

            <!-- Dashboard Menu bar load here-->
            <div class="load_data_container w-[20%]"></div>

            <div class="flex flex-col w-[79%] h-fit">

                <h1 id="" class="mt-12 mb-1 ml-4 font-serif text-2xl font-bold w-fit">Order Details</h1>

                <div class="flex h-10 gap-4 ml-4 text-xl text-white bg-slate-800 justify-evenly">
                    <button id="paid" class=" w-[350px] hover:bg-slate-400">Paid Orders</button>
                    <button id="completed" class=" w-[350px] hover:bg-slate-400">Completed Orders</button>
                    <button id="canceled" class=" w-[350px] hover:bg-slate-400">Canceled Orders</button>
                </div>
                
                <div class="flex flex-col w-full">
                    <div class="ml-4 mt-7">
                        
                        <!-- Paid order table section -->
                        <div id="paid_container" class="flex flex-col" >

                            <div class="gap-1">
                                
                                <form action="" method="post" class="flex mt-1">
                                    <div class="flex gap-2">
                                        <input type="text" class="h-8 p-1 font-sans text-black rounded-md border-1 w-96" name="paid_orders" value="<?php if(isset($_POST['paid_orders'])){ echo $_POST['paid_orders']; } ?>" placeholder="Search By Product Category">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-center h-8 w-[100px] rounded-lg">Search</button>
                                    </div>  
                                </form>                                           
                            </div>
                
                            <div class="mt-3">
                                <div class="" id="customer_table" style="max-height: 600px; overflow-y: auto;">
                                    <table class="w-full font-sans text-center text-white table-auto table-hover">
                                        <thead>
                                            <tr class="h-10 text-center text-black bg-white">
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Customer type</th>
                                                <th>Provider</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            <tr>   
                                        </thead>
                                        <tbody id="">
                                            <?php
                                                require('db_conn.php');                      

                                                // search payment detials show here

                                                $search = trim(isset($_POST['paid_orders'])) ? $_POST['paid_orders'] : '';
                                                if($search != '') {
                                                    
                                                    $order_category = "%" . $conn->real_escape_string($_POST['paid_orders']). "%";
                                                    $query_1 = "SELECT * FROM transaction WHERE payment_status = 'succeeded' AND (item_name LIKE ? OR item_category LIKE ?) ORDER BY Reference_id DESC";
                                                    $stmt = $conn->prepare($query_1); 
                                
                                                    if ($stmt === false) {
                                
                                                        die('Prepare error: ' . $conn->error);
                                                        
                                                    }
                                                    
                                                    $stmt->bind_param("ss", $order_category,$order_category);
                                
                                                    // Execute the statement
                                                    if (!$stmt->execute()) {
                                                        die('Execute error: ' . $stmt->error);
                                                    }
                                
                                                    // Get result set from the statement
                                                    $result = $stmt->get_result();

                                                    if($result && $result->num_rows > 0) {
                                                        
                                                        while($row = $result->fetch_assoc()) {
                                                            
                                                            if($row['customer_type'] == "farmer"){

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$id'";
                                                                $result_farmer = $conn->query($SELECT);
                                                                $row_farmer = $result_farmer->fetch_assoc();
                                                                $username = $row_farmer['username'];
                                                                
                                                            }else if($row['customer_type'] == "customer"){
                                                                 
                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM customer WHERE customer_id = '$id'";
                                                                $result_customer = $conn->query($SELECT);
                                                                $row_customer = $result_customer->fetch_assoc();
                                                                $username = $row_customer['username'];
                                                            }else{

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$id'";
                                                                $result_supplier = $conn->query($SELECT);
                                                                $row_supplier = $result_supplier->fetch_assoc();
                                                                $username = $row_supplier['username'];

                                                            }

                                                            switch ($row['provider_type']) {
                                                                case 'supplier':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$provider_id'";
                                                                    $result_supplier1 = $conn->query($SELECT);
                                                                    $row_supplier1 = $result_supplier1->fetch_assoc();
                                                                    $provider_username = $row_supplier1['username'];
                                                                    break;
                                                                case 'farmer':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$provider_id'";
                                                                    $result_farmer1 = $conn->query($SELECT);
                                                                    $row_farmer1 = $result_farmer1->fetch_assoc();
                                                                    $provider_username = $row_farmer1['username'];;
                                                                    break;
                                                                
                                                            }
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td ><?= $row['Reference_id']; ?></td>
                                                                    <td ><?= $username; ?></td>
                                                                    <td ><?= $row['customer_type']; ?></td>
                                                                    <td ><?= $provider_username; ?></td>
                                                                    <td ><?= $row['item_name']; ?></td>
                                                                    <td ><?= $row['item_category']; ?></td>
                                                                    <td ><?= "Rs ".$row['total_amount']; ?></td>
                                                                    <td><label class="pl-1 pr-1 pt-0.5 pb-0.5 mt-1 mb-1 bg-green-500 rounded-md h-fit w-fit"><?= ucfirst($row['payment_status']); ?></label></td>
                                                                </tr>

                                                            <?php
                                                        }
                                                        $stmt->close();

                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">No Record Found</td>
                                                        </tr>
                                                        <?php
                                                    }

                                                }else{


                                                    $query = "SELECT * FROM transaction WHERE payment_status = 'succeeded' ORDER BY Reference_id DESC";

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

                                                            if($row['customer_type'] == "farmer"){

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$id'";
                                                                $result_farmer = $conn->query($SELECT);
                                                                $row_farmer = $result_farmer->fetch_assoc();
                                                                $username = $row_farmer['username'];
                                                                
                                                            }else if($row['customer_type'] == "customer"){
                                                                 
                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM customer WHERE customer_id = '$id'";
                                                                $result_customer = $conn->query($SELECT);
                                                                $row_customer = $result_customer->fetch_assoc();
                                                                $username = $row_customer['username'];
                                                            }else{

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$id'";
                                                                $result_supplier = $conn->query($SELECT);
                                                                $row_supplier = $result_supplier->fetch_assoc();
                                                                $username = $row_supplier['username'];

                                                            }

                                                            switch ($row['provider_type']) {
                                                                case 'supplier':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$provider_id'";
                                                                    $result_supplier1 = $conn->query($SELECT);
                                                                    $row_supplier1 = $result_supplier1->fetch_assoc();
                                                                    $provider_username = $row_supplier1['username'];
                                                                    break;
                                                                case 'farmer':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$provider_id'";
                                                                    $result_farmer1 = $conn->query($SELECT);
                                                                    $row_farmer1 = $result_farmer1->fetch_assoc();
                                                                    $provider_username = $row_farmer1['username'];;
                                                                    break;
                                                                
                                                            }
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td ><?= $row['Reference_id']; ?></td>
                                                                    <td ><?= $username; ?></td>
                                                                    <td ><?= $row['customer_type']; ?></td>
                                                                    <td ><?= $provider_username; ?></td>
                                                                    <td ><?= $row['item_name']; ?></td>
                                                                    <td ><?= $row['item_category']; ?></td>
                                                                    <td ><?= "Rs ".$row['total_amount']; ?></td>
                                                                    <td><label class="pl-1 pr-1 pt-0.5 pb-0.5 mt-1 mb-1 bg-green-500 rounded-md h-fit w-fit"><?= ucfirst($row['payment_status']); ?></label></td>
                                                                </tr>

                                                            <?php
                                                        }
                                                        $stmt->close();

                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">No Record Found</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                $conn->close();
                                    
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- complete order table section -->
                        <div id="complete_container" class="flex flex-col" style="display: none;">

                            <div class="gap-1">
                                
                                <form action="" method="post" class="flex mt-1">
                                    <div class="flex gap-2">
                                        <input type="text" class="h-8 p-1 font-sans text-black rounded-md border-1 w-96" name="complete_orders" value="<?php if(isset($_POST['complete_orders'])){ echo $_POST['complete_orders']; } ?>" placeholder="Search By Product Category">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-center h-8 w-[100px] rounded-lg">Search</button>
                                    </div>  
                                </form> 

                            </div>
                
                            <div class="mt-3">
                                <div class="" id="customer_table" style="max-height: 600px; overflow-y: auto;">
                                    <table class="w-full font-sans text-center text-white table-auto table-hover">
                                        <thead>
                                            <tr class="h-10 text-center text-black bg-white">
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Customer type</th>
                                                <th>Provider</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            <tr>   
                                        </thead>
                                        <tbody id="">
                                            <?php
                                                require('db_conn.php');                      

                                                // search payment detials show here
                                                $search1 = trim(isset($_POST['complete_orders'])) ? $_POST['complete_orders'] : '';
                                                if($search1 != '') {
                                                    
                                                    // Sanitize and prepare the search term
                                                    $order_category_or_item_name = "%" . $conn->real_escape_string($_POST['complete_orders']) . "%";

                                                    // Updated query
                                                    $query_1 = "SELECT * FROM transaction 
                                                                WHERE payment_status = 'Completed' 
                                                                AND (item_name LIKE ? OR item_category LIKE ?) 
                                                                ORDER BY Reference_id DESC";

                                                    $stmt = $conn->prepare($query_1);

                                                    if ($stmt === false) {
                                                        die('Prepare error: ' . $conn->error);
                                                    }

                                                    // Bind the search term to both placeholders
                                                    $stmt->bind_param("ss", $order_category_or_item_name, $order_category_or_item_name);

                                                    // Execute the statement
                                                    if (!$stmt->execute()) {
                                                        die('Execute error: ' . $stmt->error);
                                                    }

                                                    // Get result set from the statement
                                                    $result = $stmt->get_result();


                                                    if($result && $result->num_rows > 0) {
                                                        
                                                        while($row = $result->fetch_assoc()) {
                                                            
                                                            if($row['customer_type'] == "farmer"){

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$id'";
                                                                $result_farmer = $conn->query($SELECT);
                                                                $row_farmer = $result_farmer->fetch_assoc();
                                                                $username = $row_farmer['username'];
                                                                
                                                            }else if($row['customer_type'] == "customer"){
                                                                 
                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM customer WHERE customer_id = '$id'";
                                                                $result_customer = $conn->query($SELECT);
                                                                $row_customer = $result_customer->fetch_assoc();
                                                                $username = $row_customer['username'];
                                                            }else{

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$id'";
                                                                $result_supplier = $conn->query($SELECT);
                                                                $row_supplier = $result_supplier->fetch_assoc();
                                                                $username = $row_supplier['username'];

                                                            }

                                                            switch ($row['provider_type']) {
                                                                case 'supplier':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$provider_id'";
                                                                    $result_supplier1 = $conn->query($SELECT);
                                                                    $row_supplier1 = $result_supplier1->fetch_assoc();
                                                                    $provider_username = $row_supplier1['username'];
                                                                    break;
                                                                case 'farmer':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$provider_id'";
                                                                    $result_farmer1 = $conn->query($SELECT);
                                                                    $row_farmer1 = $result_farmer1->fetch_assoc();
                                                                    $provider_username = $row_farmer1['username'];;
                                                                    break;
                                                                
                                                            }
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td ><?= $row['Reference_id']; ?></td>
                                                                    <td ><?= $username; ?></td>
                                                                    <td ><?= $row['customer_type']; ?></td>
                                                                    <td ><?= $provider_username; ?></td>
                                                                    <td ><?= $row['item_name']; ?></td>
                                                                    <td ><?= $row['item_category']; ?></td>
                                                                    <td ><?= "Rs ".$row['total_amount']; ?></td>
                                                                    <td class="flex items-center justify-center text-center ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#22c55e" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="mt-1 size-8">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                        </svg>
                                                                    </td>
                                                                </tr>

                                                            <?php
                                                        }
                                                        $stmt->close();

                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">No Record Found</td>
                                                        </tr>
                                                        <?php
                                                    }

                                                }else{


                                                    $query = "SELECT * FROM transaction WHERE payment_status = 'Completed' ORDER BY Reference_id DESC";

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

                                                            if($row['customer_type'] == "farmer"){

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$id'";
                                                                $result_farmer = $conn->query($SELECT);
                                                                $row_farmer = $result_farmer->fetch_assoc();
                                                                $username = $row_farmer['username'];
                                                                
                                                            }else if($row['customer_type'] == "customer"){
                                                                 
                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM customer WHERE customer_id = '$id'";
                                                                $result_customer = $conn->query($SELECT);
                                                                $row_customer = $result_customer->fetch_assoc();
                                                                $username = $row_customer['username'];
                                                            }else{

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$id'";
                                                                $result_supplier = $conn->query($SELECT);
                                                                $row_supplier = $result_supplier->fetch_assoc();
                                                                $username = $row_supplier['username'];

                                                            }

                                                            switch ($row['provider_type']) {
                                                                case 'supplier':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$provider_id'";
                                                                    $result_supplier1 = $conn->query($SELECT);
                                                                    $row_supplier1 = $result_supplier1->fetch_assoc();
                                                                    $provider_username = $row_supplier1['username'];
                                                                    break;
                                                                case 'farmer':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$provider_id'";
                                                                    $result_farmer1 = $conn->query($SELECT);
                                                                    $row_farmer1 = $result_farmer1->fetch_assoc();
                                                                    $provider_username = $row_farmer1['username'];;
                                                                    break;
                                                                
                                                            }
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td ><?= $row['Reference_id']; ?></td>
                                                                    <td ><?= $username; ?></td>
                                                                    <td ><?= $row['customer_type']; ?></td>
                                                                    <td ><?= $provider_username; ?></td>
                                                                    <td ><?= $row['item_name']; ?></td>
                                                                    <td ><?= $row['item_category']; ?></td>
                                                                    <td ><?= "Rs ".$row['total_amount']; ?></td>
                                                                    <td class="flex items-center justify-center h-full text-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#22c55e" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="mt-1 size-7">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                        </svg>
                                                                    </td>
                                                                </tr>

                                                            <?php
                                                        }
                                                        $stmt->close();

                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">No Record Found</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                $conn->close();
                                    
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- cancel order table section -->
                        <div id="cancel_container" class="flex flex-col" style="display: none;">

                            <div class="gap-1">
                                
                                <form action="" method="post" class="flex mt-1">
                                    <div class="flex gap-2">
                                        <input type="text" class="h-8 p-1 font-sans text-black rounded-md border-1 w-96" name="cancel_orders" value="<?php if(isset($_POST['cancel_orders'])){ echo $_POST['cancel_orders']; } ?>" placeholder="Search By Product Category">
                                        <button  type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-center h-8 w-[100px] rounded-lg">Search</button>
                                    </div>  
                                </form>

                            </div>
                
                            <div class="mt-3">
                                <div class="" id="customer_table" style="max-height: 610px; overflow-y: auto;">
                                    <table class="w-full font-sans text-center text-white table-auto table-hover">
                                        <thead>
                                            <tr class="h-10 text-center text-black bg-white">
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Customer type</th>
                                                <th>Provider</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            <tr>   
                                        </thead>
                                        <tbody id="">
                                            <?php
                                                require('db_conn.php');                      

                                                // search payment detials show here
                                                $search2 = trim(isset($_POST['cancel_orders'])) ? $_POST['cancel_orders'] : '';
                                                if($search2 != '') {
                                                    
                                                    $order_category = "%" . $conn->real_escape_string($_POST['cancel_orders']). "%";
                                                    $query_1 = "SELECT * FROM transaction WHERE payment_status = 'Canceled' AND (item_name LIKE ? OR item_category LIKE ?) ORDER BY Reference_id DESC";
                                                    $stmt = $conn->prepare($query_1); 
                                
                                                    if ($stmt === false) {
                                
                                                        die('Prepare error: ' . $conn->error);
                                                        
                                                    }
                                                    
                                                    $stmt->bind_param("ss", $order_category,$order_category);
                                
                                                    // Execute the statement
                                                    if (!$stmt->execute()) {
                                                        die('Execute error: ' . $stmt->error);
                                                    }
                                
                                                    // Get result set from the statement
                                                    $result = $stmt->get_result();

                                                    if($result && $result->num_rows > 0) {
                                                        
                                                        while($row = $result->fetch_assoc()) {
                                                            
                                                            if($row['customer_type'] == "farmer"){

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$id'";
                                                                $result_farmer = $conn->query($SELECT);
                                                                $row_farmer = $result_farmer->fetch_assoc();
                                                                $username = $row_farmer['username'];
                                                                
                                                            }else if($row['customer_type'] == "customer"){
                                                                 
                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM customer WHERE customer_id = '$id'";
                                                                $result_customer = $conn->query($SELECT);
                                                                $row_customer = $result_customer->fetch_assoc();
                                                                $username = $row_customer['username'];
                                                            }else{

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$id'";
                                                                $result_supplier = $conn->query($SELECT);
                                                                $row_supplier = $result_supplier->fetch_assoc();
                                                                $username = $row_supplier['username'];

                                                            }

                                                            switch ($row['provider_type']) {
                                                                case 'supplier':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$provider_id'";
                                                                    $result_supplier1 = $conn->query($SELECT);
                                                                    $row_supplier1 = $result_supplier1->fetch_assoc();
                                                                    $provider_username = $row_supplier1['username'];
                                                                    break;
                                                                case 'farmer':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$provider_id'";
                                                                    $result_farmer1 = $conn->query($SELECT);
                                                                    $row_farmer1 = $result_farmer1->fetch_assoc();
                                                                    $provider_username = $row_farmer1['username'];;
                                                                    break;
                                                                
                                                            }
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td ><?= $row['Reference_id']; ?></td>
                                                                    <td ><?= $username; ?></td>
                                                                    <td ><?= $row['customer_type']; ?></td>
                                                                    <td ><?= $provider_username; ?></td>
                                                                    <td ><?= $row['item_name']; ?></td>
                                                                    <td ><?= $row['item_category']; ?></td>
                                                                    <td ><?= "Rs ".$row['total_amount']; ?></td>
                                                                    <td class="flex items-center justify-center text-center ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#FF0000" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-1 size-8">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                        </svg>
                                                                    </td>
                                                                </tr>

                                                            <?php
                                                        }
                                                        $stmt->close();

                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">No Record Found</td>
                                                        </tr>
                                                        <?php
                                                    }

                                                }else{


                                                    $query = "SELECT * FROM transaction WHERE payment_status = 'Canceled' ORDER BY Reference_id DESC";

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

                                                            if($row['customer_type'] == "farmer"){

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$id'";
                                                                $result_farmer = $conn->query($SELECT);
                                                                $row_farmer = $result_farmer->fetch_assoc();
                                                                $username = $row_farmer['username'];
                                                                
                                                            }else if($row['customer_type'] == "customer"){
                                                                 
                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM customer WHERE customer_id = '$id'";
                                                                $result_customer = $conn->query($SELECT);
                                                                $row_customer = $result_customer->fetch_assoc();
                                                                $username = $row_customer['username'];
                                                            }else{

                                                                $id = $row['customer_id'];
                                                                $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$id'";
                                                                $result_supplier = $conn->query($SELECT);
                                                                $row_supplier = $result_supplier->fetch_assoc();
                                                                $username = $row_supplier['username'];

                                                            }

                                                            switch ($row['provider_type']) {
                                                                case 'supplier':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM supplier WHERE supplier_id = '$provider_id'";
                                                                    $result_supplier1 = $conn->query($SELECT);
                                                                    $row_supplier1 = $result_supplier1->fetch_assoc();
                                                                    $provider_username = $row_supplier1['username'];
                                                                    break;
                                                                case 'farmer':
                                                                    $provider_id = $row['provider_id'];
                                                                    $SELECT = "SELECT username FROM farmer WHERE farmer_id = '$provider_id'";
                                                                    $result_farmer1 = $conn->query($SELECT);
                                                                    $row_farmer1 = $result_farmer1->fetch_assoc();
                                                                    $provider_username = $row_farmer1['username'];;
                                                                    break;
                                                                
                                                            }
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td ><?= $row['Reference_id']; ?></td>
                                                                    <td ><?= $username; ?></td>
                                                                    <td ><?= $row['customer_type']; ?></td>
                                                                    <td ><?= $provider_username; ?></td>
                                                                    <td ><?= $row['item_name']; ?></td>
                                                                    <td ><?= $row['item_category']; ?></td>
                                                                    <td ><?= "Rs ".$row['total_amount']; ?></td>
                                                                    <td class="flex items-center justify-center h-full text-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#FF0000" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="mt-1 size-8">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                        </svg>
                                                                    </td>
                                                                </tr>

                                                            <?php
                                                        }
                                                        $stmt->close();

                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">No Record Found</td>
                                                        </tr>
                                                        <?php
                                                    }
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

            </div>

        </div>

    </div>

    <!-- load side menu bar  -->
    <script>
        $(document).ready(function(){
            $('.load_data_container').load('sendcode/adminpanel.php');
        })
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- view paid and completed, canceled orders  -->
    <!-- chanage button color after selected -->
    <script>
        // Get button elements
        const buttons = document.querySelectorAll("#canceled, #completed, #paid");

        // Get content elements
        const canceled_orders = document.getElementById("cancel_container");
        const completed_orders = document.getElementById("complete_container");
        const paid_container = document.getElementById("paid_container");

        <?php 
            if (isset($_POST['complete_orders'])) {
                ?>
                completed_orders.style.display = "flex";
                canceled_orders.style.display = "none";
                paid_container.style.display = "none";
                <?php

            }
            elseif (isset($_POST['cancel_orders'])) {
                ?>
                canceled_orders.style.display = "flex";
                completed_orders.style.display = "none";
                paid_container.style.display = "none";
                <?php
            }

        ?>

        // Function to handle button clicks
        function handleButtonClick(activeButtonId) {

            // Reset all buttons and content
            buttons.forEach((btn) => btn.classList.remove("active"));
            canceled_orders.style.display = "none";
            completed_orders.style.display = "none";
            paid_container.style.display = "none";

            // Set the active button and show corresponding content
            document.getElementById(activeButtonId).classList.add("active");

            switch (activeButtonId) {
                case "canceled":
                    canceled_orders.style.display = "flex";
                    break;
                case "completed":
                    completed_orders.style.display = "flex";
                    break;
                case "paid":
                    paid_container.style.display = "flex";
                    break;
            }
        }

        // Attach event listeners to buttons
        buttons.forEach((btn) => {
            btn.addEventListener("click", () => handleButtonClick(btn.id));
        });
        
    </script>



</body>

</html>