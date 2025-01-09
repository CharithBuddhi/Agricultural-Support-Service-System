<?php 
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Colombo');
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
    </style>
</head>
<body class="bg-[#1c4094] text-white">
    
    <div class="w-screen h-screen">

        <div class="flex w-full h-full">

            <!-- Dashboard Menu bar load here-->
            <div class="load_data_container w-[20%]"></div>

            <div class="flex flex-col w-[79%] h-fit" >

                <div class="flex flex-col gap-10 mt-16 ml-8 text-black">

                    <!-- Main Reports -->
                    <fieldset class="rounded-2xl border-2 h-fit p-5 border-white w-[72%]">
                        
                        <legend class="text-xl font-bold text-white ">Main Report</legend>
    
                        <button id="control_price_report_btn" class="w-[200px] bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Latest Control Price</h1>
                        </button>

                        <button id="previuse_control_price_report_btn" class="w-[200px] ml-5 bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Previous Control Price</h1>
                        </button>
    
                        <button class="w-[200px] ml-5 bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Transaction Report</h1>
                        </button>
    
                    </fieldset>
    
                    <!-- Product Reports -->
                    <fieldset class="rounded-2xl border-2 h-fit p-5 border-white w-[50%]">
                        
                        <legend class="text-xl font-bold text-white ">Product Reports</legend>
    
                        <button class="w-[200px] bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Product Report</h1>
                        </button>
    
                        <button class="w-[200px] ml-5 bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Order Report</h1>
                        </button>
    
                    </fieldset>
    
                    <!-- User Reports -->
                    <fieldset class="rounded-2xl border-2 h-fit p-5 border-white w-[95%]">
                        
                        <legend class="text-xl font-bold text-white ">User Reports</legend>
    
                        <button id="farmer_report" class="w-[200px] bg-white hover:bg-blue-300 rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Farmer Report</h1>
                        </button>
    
                        <button id="customer_report" value="customer_report" class="w-[200px] ml-5 bg-white hover:bg-blue-300 rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Customer Report</h1>
                        </button>
    
                        <button id="supplier_report" class="w-[200px] ml-5 bg-white hover:bg-blue-300 rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Supplier Report</h1>
                        </button>

                        <button name="staff_report" id="staff_report" class="w-[200px] ml-5 hover:bg-blue-300 bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Staff Report</h1>
                        </button>
    
                    </fieldset>
    
                    <!-- Other Reports -->
                    <fieldset class="rounded-2xl border-2 h-fit p-5 border-white w-[95%]">
                        
                        <legend class="text-xl font-bold text-white ">Other Reports</legend>
    
                        <button class="w-[200px] bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Supplier Requeasted</h1>
                        </button>

                        <button class="w-[200px] ml-5 bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Farmer Requeasted</h1>
                        </button>
    
                        <button class="w-[200px] ml-5 bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Technology Report</h1>
                        </button>
    
                        <button class="w-[200px] ml-5 bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Verites Report</h1>
                        </button>
    
                        <button class="w-[200px] mt-5 bg-white rounded-md">
                            <h1 class="p-1 text-lg font-semibold text-left">Nutrient Report</h1>
                        </button>
    
                    </fieldset>

                </div>
                        
                </div> 
                
            </div>

        </div>
    </div>

    <!-- User Reports Generate Input -->
    <div id="modal_input" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[420px]">

            <!-- Modal Header -->
            <div class="flex justify-between mb-5">
                <b><h5 class="modal-title" id="exampleModalLabel">Generate User Reports</h5></b>
            </div>

            <!-- Modal Body -->
            <form action="" method="POST">
                <div class="">
                    <div class="flex flex-col gap-2"> 
                        
                        <input type="text" id="user_type" name="user_type" value="" hidden>
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="user_status"><u>By Date</u></label>
                            <div class="flex gap-5">
                                <div>
                                    <label for="start_date">To</label>
                                    <input type="date" name="start_date" id="start_date" class="h-10 border-2 rounded-lg w-44 border-slate-300">
                                </div>
                                <div>
                                    <label for="end_date">From</label>
                                    <input type="date" name="end_date" id="end_date" class="h-10 border-2 rounded-lg w-44 border-slate-300" value="">
                                </div>
                            </div>
                        </div>
                        
                        <div id="user_status_div" class="flex flex-col gap-1 font-bold">
                            <label for="status"><u>By Status</u></label>
                            <select name="user_status" id="status" class="h-10 border-2 rounded-lg w-[378px] border-slate-300">
                                <option value="all">All Users</option>
                                <option value="active">Active Users</option>
                                <option value="hold">Hold Users</option>
                            </select>
                        </div>
                    

                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-4 text-center">
                    <button type="button" id="close_report_genarate" class="w-24 transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                    <button type="submit" name="report_genarate" id="report_genarate"  class="w-24 transition bg-blue-500 rounded-lg h-9 hover:bg-blue-600">Genarate</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Generate user report show -->
    <?php
        require('db_conn.php');
        if(isset($_POST['report_genarate'])){
            $user_type = $_POST['user_type'];
            $user_status = $_POST['user_status'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            if($user_type =="customer"){
                ?>
                    <!-- Reports customer -->
                    <div id="Report_customer" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
                        
                        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[1250px]">

                            <!-- Modal Header -->
                            <div class="flex flex-col justify-between gap-1 mb-3">
                                <b><h5 class="text-lg modal-title" id="exampleModalLabel">Customer Details Report</h5></b>
                                <h5 class="modal-title" id="exampleModalLabel">Create Date: <?php echo date('Y-m-d h:i:s'); ?></h5>
                            </div>
                        
                            <!-- Modal Body -->
                            <form action="" method="POST">

                                <div class="">

                                    <table cellpadding="10">
                                        <thead>
                                            <tr class="border-b-2 border-slate-300">
                                                <th>Registrer Date</th>
                                                <th>Customer Id</th>
                                                <th>Customer Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                            </tr>
                                        <thead>
                                        <tbody class="border-separate border-spacing-x-3">
                                            <?php

                                                if(!empty(trim($user_type)) && !empty(trim($user_status)) && !empty(trim($start_date)) && !empty(trim($end_date))){

                                                    if($user_status == "hold"){
                                                        $user_status = 1;
                                                        $select = "SELECT * FROM $user_type WHERE customer_status = '$user_status' AND DATE(create_time) BETWEEN '$start_date' AND '$end_date'";
                                                    }else if($user_status == "active"){
                                                        $user_status = 0;
                                                        $select = "SELECT * FROM $user_type WHERE customer_status = '$user_status' AND DATE(create_time) BETWEEN '$start_date' AND '$end_date'";
                                                    }
                                                    else if($user_status == "all"){
                                                        $select = "SELECT * FROM $user_type WHERE DATE(create_time) BETWEEN '$start_date' AND '$end_date'";
                                                    }
                                                    $query_run = mysqli_query($conn, $select);
                                                    
                                                    if(mysqli_num_rows($query_run) >  0){
                                                
                                                        while($row = $query_run->fetch_assoc()) {
                                                            ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $row['create_time']; ?></td>
                                                                    <td class="text-center"><?php echo $row['customer_id']; ?></td>
                                                                    <td class="text-center"><?php echo $row['customer_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['username']; ?></td>
                                                                    <td class="text-center"><?php echo $row['customer_email']; ?></td>
                                                                    <td class="text-center"><?php echo $row['customer_address']; ?></td>
                                                                    <td class="text-center"><?php echo $row['customer_telno']; ?></td>
                                                                    <?php if($row['customer_status'] == 0){ ?>
                                                                            <td class="text-center">Active</td>
                                                                    <?php }else if($row['customer_status'] == 1){ ?>
                                                                            <td class="text-center">Hold</td>
                                                                    <?php } ?>
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                        
                                                }else if(!empty(trim($user_type)) && !empty(trim($user_status)) || empty(trim($start_date)) || empty(trim($end_date))){

                                                    if($user_status == "hold"){
                                                        $user_status = 1;
                                                        $select = "SELECT * FROM $user_type WHERE customer_status = '$user_status'";
                                                    }else if($user_status == "active"){
                                                        $user_status = 0;
                                                        $select = "SELECT * FROM $user_type WHERE customer_status = '$user_status'";
                                                    }
                                                    else if($user_status == "all"){
                                                        $select = "SELECT * FROM $user_type";
                                                    }
                                                    $query_run = mysqli_query($conn, $select);
                                                    
                                                    if(mysqli_num_rows($query_run) >  0){
                                                
                                                        while($row = $query_run->fetch_assoc()) {
                                                            ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $row['create_time']; ?></td>
                                                                    <td class="text-center"><?php echo $row['customer_id']; ?></td>
                                                                    <td class="text-center"><?php echo $row['customer_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['username']; ?></td>
                                                                    <td class="text-center"><?php echo $row['customer_email']; ?></td>
                                                                    <td class="text-center"><?php echo $row['customer_address']; ?></td>
                                                                    <td class="text-center"><?php echo $row['customer_telno']; ?></td>
                                                                    <?php if($row['customer_status'] == 0){ ?>
                                                                            <td class="text-center">Active</td>
                                                                    <?php }else if($row['customer_status'] == 1){ ?>
                                                                            <td class="text-center">Hold</td>
                                                                    <?php } ?>
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                                <!-- Modal Footer -->
                                <div class="flex justify-end gap-2 mt-4 text-center">
                                    <button type="button" id="close" class="w-24 transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                                </div>
                                
                            </form>

                        </div>

                    </div>
                <?php
            }else if($user_type =="farmer"){
                ?>
                    <!-- Reports farmer -->
                    <div id="Report_farmer" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
                        
                        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[1250px] max-w-max">

                            <!-- Modal Header -->
                            <div class="flex flex-col justify-between gap-1 mb-3">
                                <b><h5 class="text-lg modal-title" id="exampleModalLabel">Farmer Details Report</h5></b>
                                <h5 class="modal-title" id="exampleModalLabel">Create Date: <?php echo date('Y-m-d h:i:s'); ?></h5>
                            </div>
                        
                            <!-- Modal Body -->
                            <form action="" method="POST">

                                <div class="overflow-auto snap-x">

                                    <table cellpadding="10" class=" snap-align-none">
                                        <thead class="">
                                            <tr class="border-b-2 border-slate-300">
                                                <th>Register Date</th>
                                                <th>Staff ID</th>
                                                <th>Farmer Id</th>
                                                <th>Farmer Name</th>
                                                <th>Username</th>
                                                <th>Farmer NIC</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Bank</th>
                                                <th>Acoount Name</th>
                                                <th>Acoount NO</th>
                                                <th>Branch Name</th>
                                                <th>Status</th>
                                                <th>Update Date</th>
                                            </tr>
                                        <thead>
                                        <tbody class="border-separate border-spacing-x-3">
                                            <?php

                                                if(!empty(trim($user_type)) && !empty(trim($user_status)) && !empty(trim($start_date)) && !empty(trim($end_date))){

                                                    if($user_status == "hold"){
                                                        $user_status = 1;
                                                        $select = "SELECT * FROM $user_type WHERE farmer_status = '$user_status' AND DATE(create_time) BETWEEN '$start_date' AND '$end_date'";
                                                    }else if($user_status == "active"){
                                                        $user_status = 0;
                                                        $select = "SELECT * FROM $user_type WHERE farmer_status = '$user_status' AND DATE(create_time) BETWEEN '$start_date' AND '$end_date'";
                                                    }
                                                    else if($user_status == "all"){
                                                        $select = "SELECT * FROM $user_type WHERE DATE(create_time) BETWEEN '$start_date' AND '$end_date'";
                                                    }
                                                    $query_run = mysqli_query($conn, $select);
                                                    
                                                    if(mysqli_num_rows($query_run) >  0){
                                                
                                                        while($row = $query_run->fetch_assoc()) {
                                                            ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $row['create_time']; ?></td>
                                                                    <td class="text-center"><?php echo $row['response']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_id']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['username']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_nic']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_email']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_address']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_phone']; ?></td>
                                                                    <td class="text-center"><?php echo $row['bank_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['account_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['account_no']; ?></td>
                                                                    <td class="text-center"><?php echo $row['branch_name']; ?></td>
                                                                    <?php if($row['farmer_status'] == 0){ ?>
                                                                            <td class="text-center">Active</td>
                                                                    <?php }else if($row['farmer_status'] == 1){ ?>
                                                                            <td class="text-center">Hold</td>
                                                                    <?php } ?>
                                                                    <td class="text-center"><?php echo $row['update_time']; ?></td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                        
                                                }else if(!empty(trim($user_type)) && !empty(trim($user_status)) || empty(trim($start_date)) || empty(trim($end_date))){

                                                    if($user_status == "hold"){
                                                        $user_status = 1;
                                                        $select = "SELECT * FROM $user_type WHERE farmer_status = '$user_status'";
                                                    }else if($user_status == "active"){
                                                        $user_status = 0;
                                                        $select = "SELECT * FROM $user_type WHERE farmer_status = '$user_status'";
                                                    }
                                                    else if($user_status == "all"){
                                                        $select = "SELECT * FROM $user_type";
                                                    }
                                                    $query_run = mysqli_query($conn, $select);
                                                    
                                                    if(mysqli_num_rows($query_run) >  0){
                                                
                                                        while($row = $query_run->fetch_assoc()) {
                                                            ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $row['create_time']; ?></td>
                                                                    <td class="text-center"><?php echo $row['response']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_id']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['username']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_nic']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_email']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_address']; ?></td>
                                                                    <td class="text-center"><?php echo $row['farmer_phone']; ?></td>
                                                                    <td class="text-center"><?php echo $row['bank_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['account_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['account_no']; ?></td>
                                                                    <td class="text-center"><?php echo $row['branch_name']; ?></td>
                                                                    <?php if($row['farmer_status'] == 0){ ?>
                                                                            <td class="text-center">Active</td>
                                                                    <?php }else if($row['farmer_status'] == 1){ ?>
                                                                            <td class="text-center">Hold</td>
                                                                    <?php } ?>
                                                                    <td class="text-center"><?php echo $row['update_time']; ?></td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                                <!-- Modal Footer -->
                                <div class="flex justify-end gap-2 mt-4 text-center">
                                    <button type="button" id="close_farmer_report_btn" class="w-24 transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                                </div>
                                
                            </form>

                        </div>

                    </div>
                <?php
            }else if($user_type =="supplier"){
                ?>
                    <!-- Reports supplier -->
                    <div id="Report_supplier" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
    
                        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[1250px] max-w-max">

                            <!-- Modal Header -->
                            <div class="flex flex-col justify-between gap-1 mb-3">
                                <b><h5 class="text-lg modal-title" id="exampleModalLabel">Supplier Details Report</h5></b>
                                <h5 class="modal-title" id="exampleModalLabel">Create Date: <?php echo date('Y-m-d h:i:s'); ?></h5>
                            </div>
                        
                            <!-- Modal Body -->
                            <form action="" method="POST">

                                <div class="overflow-auto snap-x">

                                    <table cellpadding="10" class=" snap-align-none">
                                        <thead class="">
                                            <tr class="border-b-2 border-slate-300">
                                                <th>Register Date</th>
                                                <th>Staff ID</th>
                                                <th>Supplier Id</th>
                                                <th>Supplier Name</th>
                                                <th>Username</th>
                                                <th>Shop Name</th>
                                                <th>Supplier NIC</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Bank</th>
                                                <th>Acoount Name</th>
                                                <th>Acoount NO</th>
                                                <th>Branch Name</th>
                                                <th>Status</th>
                                                <th>Update Date</th>
                                            </tr>
                                        <thead>
                                        <tbody class="border-separate border-spacing-x-3">
                                            <?php

                                                if(!empty(trim($user_type)) && !empty(trim($user_status)) && !empty(trim($start_date)) && !empty(trim($end_date))){

                                                    if($user_status == "hold"){
                                                        $user_status = 1;
                                                        $select = "SELECT * FROM $user_type WHERE farmer_status = '$user_status' AND DATE(create_time) BETWEEN '$start_date' AND '$end_date'";
                                                    }else if($user_status == "active"){
                                                        $user_status = 0;
                                                        $select = "SELECT * FROM $user_type WHERE farmer_status = '$user_status' AND DATE(create_time) BETWEEN '$start_date' AND '$end_date'";
                                                    }
                                                    else if($user_status == "all"){
                                                        $select = "SELECT * FROM $user_type WHERE DATE(create_time) BETWEEN '$start_date' AND '$end_date'";
                                                    }
                                                    $query_run = mysqli_query($conn, $select);
                                                    
                                                    if(mysqli_num_rows($query_run) >  0){
                                                
                                                        while($row = $query_run->fetch_assoc()) {
                                                            ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $row['create_time']; ?></td>
                                                                    <td class="text-center"><?php echo $row['response']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_id']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['username']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_shop_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_nic']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_email']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_address']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_phone']; ?></td>
                                                                    <td class="text-center"><?php echo $row['bank_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['account_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['account_no']; ?></td>
                                                                    <td class="text-center"><?php echo $row['branch_name']; ?></td>
                                                                    <?php if($row['supplier_status'] == 0){ ?>
                                                                            <td class="text-center">Active</td>
                                                                    <?php }else if($row['supplier_status'] == 1){ ?>
                                                                            <td class="text-center">Hold</td>
                                                                    <?php } ?>
                                                                    <td class="text-center"><?php echo $row['update_time']; ?></td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                        
                                                }else if(!empty(trim($user_type)) && !empty(trim($user_status)) || empty(trim($start_date)) || empty(trim($end_date))){

                                                    if($user_status == "hold"){
                                                        $user_status = 1;
                                                        $select = "SELECT * FROM $user_type WHERE farmer_status = '$user_status'";
                                                    }else if($user_status == "active"){
                                                        $user_status = 0;
                                                        $select = "SELECT * FROM $user_type WHERE farmer_status = '$user_status'";
                                                    }
                                                    else if($user_status == "all"){
                                                        $select = "SELECT * FROM $user_type";
                                                    }
                                                    $query_run = mysqli_query($conn, $select);
                                                    
                                                    if(mysqli_num_rows($query_run) >  0){
                                                
                                                        while($row = $query_run->fetch_assoc()) {
                                                            ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $row['create_time']; ?></td>
                                                                    <td class="text-center"><?php echo $row['response']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_id']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['username']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_shop_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_nic']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_email']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_address']; ?></td>
                                                                    <td class="text-center"><?php echo $row['supplier_phone']; ?></td>
                                                                    <td class="text-center"><?php echo $row['bank_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['account_name']; ?></td>
                                                                    <td class="text-center"><?php echo $row['account_no']; ?></td>
                                                                    <td class="text-center"><?php echo $row['branch_name']; ?></td>
                                                                    <?php if($row['supplier_status'] == 0){ ?>
                                                                            <td class="text-center">Active</td>
                                                                    <?php }else if($row['supplier_status'] == 1){ ?>
                                                                            <td class="text-center">Hold</td>
                                                                    <?php } ?>
                                                                    <td class="text-center"><?php echo $row['update_time']; ?></td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                                <!-- Modal Footer -->
                                <div class="flex justify-end gap-2 mt-4 text-center">
                                    <button type="button" id="close_supplier_report_btn" class="w-24 transition rounded-lg close_supplier_report_btn h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                                </div>
                                
                            </form>

                        </div>

                    </div>
                <?php
            }

        }

    ?>

    <!--  User Reports staff -->
    <div id="Report_staff" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">

        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[1250px] max-w-max">

            <!-- Modal Header -->
            <div class="flex flex-col justify-between gap-1 mb-3">
                <b><h5 class="text-lg modal-title" id="exampleModalLabel">Staff Details Report</h5></b>
                <h5 class="modal-title" id="exampleModalLabel">Create Date: <?php echo date('Y-m-d h:i:s'); ?></h5>
            </div>

            <!-- Modal Body -->
            <form action="" method="POST">

                <div class="overflow-auto snap-x">

                    <table cellpadding="10" class=" snap-align-none">
                        <thead class="">
                            <tr class="border-b-2 border-slate-300">
                                <th>Register Date</th>
                                <th>Staff ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Response</th>
                                <th>Update Date</th>
                            </tr>
                        <thead>
                        <tbody class="border-separate border-spacing-x-3">
                            <?php
                                require('db_conn.php');
                                $select = "SELECT * FROM staff";
                                $query_run = mysqli_query($conn, $select);
                                
                                if(mysqli_num_rows($query_run) >  0){
                            
                                    while($row = $query_run->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $row['create_time']; ?></td>
                                                <td class="text-center"><?php echo $row['staff_id']; ?></td>
                                                <td class="text-center"><?php echo $row['staff_name']; ?></td>
                                                <td class="text-center"><?php echo $row['staff_userName']; ?></td>
                                                <td class="text-center"><?php echo $row['staff_email']; ?></td>
                                                <td class="text-center"><?php echo $row['staff_type']; ?></td>
                                                <td class="text-center"><?php echo $row['reponse']; ?></td>  
                                                <td class="text-center"><?php echo $row['update_date']; ?></td>
                                            </tr>
                                        <?php
                                    }
                                }

                            ?>
                        </tbody>

                    </table>

                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-4 text-center">
                    <button type="button" id="close_staff_report_btn" class="w-24 transition rounded-lg close_supplier_report_btn h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                </div>
                
            </form>

        </div>

    </div>
    
    <!-- manage user report genarate modal view and hidden -->
    <?php
         
        if(isset($_POST['report_genarate'])){
            if($_POST['user_type'] == "customer"){
                unset($_POST['report_genarate']);
                echo '<script>
                document.getElementById("modal_input").style.display = "none";
                document.getElementById("Report_customer").style.display = "block";
                </script>';
            
            }
            else if($_POST['user_type'] == "supplier"){
                unset($_POST['report_genarate']);
                echo '<script>
                document.getElementById("modal_input").style.display = "none";
                document.getElementById("Report_supplier").style.display = "block";
                </script>';

            }else if($_POST['user_type'] == "farmer"){
                unset($_POST['report_genarate']);
                echo '<script>
                document.getElementById("modal_input").style.display = "none";
                document.getElementById("Report_farmer").style.display = "block";
                </script>';
            }
        }
      
    ?>

    <!-- contro price report data input modal -->
    <div id="control_input" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[420px]">

            <!-- Modal Header -->
            <div class="flex justify-between mb-5">
                <b><h5 class="modal-title" id="exampleModalLabel">Generate Price Reports</h5></b>
            </div>

            <!-- Modal Body -->
            <form id="control_price_rep_form" action="" method="POST">
                <div class="">
                    <div class="flex flex-col gap-2"> 
                        
                        <input type="text" id="user_type" name="user_type" value="" hidden>
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="user_status">By Date</label>
                            <div class="flex gap-5">
                                <div>
                                    <label for="start_date_control_price">To</label>
                                    <input type="date" name="start_date_control_price" id="start_date_control_price" class="h-10 border-2 rounded-lg w-44 border-slate-300">
                                </div>
                                <div>
                                    <label for="end_date_control_price">From</label>
                                    <input type="date" name="end_date_control_price" id="end_date_control_price" class="h-10 border-2 rounded-lg w-44 border-slate-300" value="">
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="crop_category">By Crop Category</label>
                            <select name="crop_category" id="crop_category" class="h-10 border-2 rounded-lg w-[378px] border-slate-300">
                                <option value="all">All Category</option>
                                <option value="Vegetable">Vagetable</option>
                                <option value="Fruit">Fruit</option>
                            </select>
                        </div>

                        <div class='flex flex-col gap-1 font-bold'>
                            <label for='crop_name'>By Crop Name</label>
                            <select id="crop_name" name="crop_name" class='h-10 border-2 rounded-lg w-[378px] border-slate-300'>
                                <option value="">Select Crop</option>
                            </select>
                        </div>
                    

                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-4 text-center">
                    <button type="button" id="close_control_price" class="w-24 transition rounded-lg h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                    <button type="submit" name="control_price_rep_genarate" id="control_price_rep_genarate"  class="w-24 transition bg-blue-500 rounded-lg h-9 hover:bg-blue-600" style="display: none;">Genarate</button>
                    <button type="submit" name="Prevoiuse_control_price_rep_genarate" id="Prevoiuse_control_price_rep_genarate"  class="w-24 transition bg-blue-500 rounded-lg h-9 hover:bg-blue-600" style="display: none;">Genarate</button>
                </div>
            </form>
        </div>
    </div>

    <!--  control price report-->
    <div id="control_price_report" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[1250px] max-w-max">

            <!-- Modal Header -->
            <div class="flex flex-col justify-between gap-1 mb-3">
                <b><h5 class="text-lg modal-title" id="exampleModalLabel">Latest Control Price Report</h5></b>
                <h5 class="modal-title" id="exampleModalLabel">Create Date: <?php echo date('Y-m-d h:i:s'); ?></h5>
            </div>
        
            <!-- Modal Body -->
            <form action="" method="POST">

                <div class="overflow-auto snap-x">

                    <table cellpadding="10" class=" snap-align-none">
                        <thead class="">
                            <tr class="border-b-2 border-slate-300">
                                <th>Pirce ID</th>
                                <th>Crop Category</th>
                                <th>Crop Name</th>
                                <th>Variety Name</th>
                                <th>Min Price</th>
                                <th>Max Price</th>
                                <th>Date</th>
                            </tr>
                        <thead>
                        <tbody class="border-separate border-spacing-x-3">
                            <?php
                                require('db_conn.php');
                                if(isset($_POST['control_price_rep_genarate'])){
                                    $crop_category = $_POST['crop_category'];
                                    $crop_name = $_POST['crop_name'];
                                    $start_date = $_POST['start_date_control_price'];
                                    $end_date = $_POST['end_date_control_price'];

                                    if(!empty(trim($crop_category)) && !empty(trim($crop_name)) && !empty(trim($start_date)) && !empty(trim($end_date))){

                                        if($crop_category == "Vegetable" || $crop_category == "Fruit"){
                                            $select = "SELECT * FROM controlprice WHERE crop_category = '$crop_category' AND crop_name = '$crop_name' AND DATE(update_date) BETWEEN '$start_date' AND '$end_date'";
                                        }
                                        else if($crop_category == "all"){
                                            $select = "SELECT * FROM controlprice WHERE crop_name = '$crop_name' AND DATE(update_date) BETWEEN '$start_date' AND '$end_date'";
                                        }
                                        $query_run = mysqli_query($conn, $select);
                                        
                                        if(mysqli_num_rows($query_run) >  0){
                                    
                                            while($row = $query_run->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['price_id']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_category']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['varieties_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['min_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['max_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['update_date']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                        else{
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                            
                                    }else if(!empty(trim($crop_category)) && empty(trim($crop_name)) && !empty(trim($start_date)) && !empty(trim($end_date))){
                                        
                                        if($crop_category == "Vegetable" || $crop_category == "Fruit"){
                                            $select = "SELECT * FROM controlprice WHERE crop_category = '$crop_category' AND DATE(update_date) BETWEEN '$start_date' AND '$end_date'";
                                        }
                                        else if($crop_category == "all"){
                                            $select = "SELECT * FROM controlprice WHERE DATE(update_date) BETWEEN '$start_date' AND '$end_date'";
                                        }
                                        $query_run = mysqli_query($conn, $select);
                                        
                                        if(mysqli_num_rows($query_run) >  0){
                                    
                                            while($row = $query_run->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['price_id']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_category']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['varieties_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['min_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['max_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['update_date']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                        
                                    }else if(!empty(trim($crop_category)) && !empty(trim($crop_name)) && empty(trim($start_date)) && empty(trim($end_date))){
                                        
                                        if($crop_category == "Vegetable" || $crop_category == "Fruit"){
                                            $select = "SELECT * FROM controlprice WHERE crop_category = '$crop_category' AND crop_name = '$crop_name'";
                                        }
                                        else if($crop_category == "all"){
                                            $select = "SELECT * FROM controlprice WHERE crop_name = '$crop_name'";
                                        }
                                        $query_run = mysqli_query($conn, $select);
                                        
                                        if(mysqli_num_rows($query_run) >  0){
                                    
                                            while($row = $query_run->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['price_id']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_category']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['varieties_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['min_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['max_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['update_date']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                    }else if(!empty(trim($crop_category)) && !empty(trim($crop_name)) && empty(trim($start_date)) && !empty(trim($end_date))){
                                        
                                        if($crop_category == "Vegetable" || $crop_category == "Fruit"){
                                            $select = "SELECT * FROM controlprice WHERE crop_category = '$crop_category' AND crop_name = '$crop_name' AND DATE(update_date) <= '$end_date'";
                                        }
                                        else if($crop_category == "all"){
                                            $select = "SELECT * FROM controlprice WHERE crop_name = '$crop_name' AND DATE(update_date) <= '$end_date'";
                                        }
                                        $query_run = mysqli_query($conn, $select);
                                        
                                        if(mysqli_num_rows($query_run) >  0){
                                    
                                            while($row = $query_run->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['price_id']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_category']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['varieties_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['min_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['max_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['update_date']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                    }else if(!empty(trim($crop_category)) && empty(trim($crop_name)) && empty(trim($start_date)) && !empty(trim($end_date))){
                                        
                                        if($crop_category == "Vegetable" || $crop_category == "Fruit"){
                                            $select = "SELECT * FROM controlprice WHERE crop_category = '$crop_category' AND DATE(update_date) <= '$end_date'";
                                        }
                                        else if($crop_category == "all"){
                                            $select = "SELECT * FROM controlprice WHERE DATE(update_date) <= '$end_date'";
                                        }
                                        $query_run = mysqli_query($conn, $select);
                                        
                                        if(mysqli_num_rows($query_run) >  0){
                                    
                                            while($row = $query_run->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['price_id']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_category']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['varieties_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['min_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['max_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['update_date']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                        
                                    }
                                }
                            ?>
                        </tbody>
                    </table>

                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-4 text-center">
                    <button type="button" id="close_control_price_rep" class="w-24 transition rounded-lg h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                </div>
                
            </form>

        </div>

    </div>

    <!--  previouse control price report-->
    <div id="previouse_control_price_report" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[1250px] max-w-max">

            <!-- Modal Header -->
            <div class="flex flex-col justify-between gap-1 mb-3">
                <b><h5 class="text-lg modal-title" id="exampleModalLabel">Previous Control Price Report</h5></b>
                <h5 class="modal-title" id="exampleModalLabel">Create Date: <?php echo date('Y-m-d h:i:s'); ?></h5>
            </div>
        
            <!-- Modal Body -->
            <form action="" method="POST">

                <div class="overflow-auto snap-x">

                    <table cellpadding="10" class=" snap-align-none">
                        <thead class="">
                            <tr class="border-b-2 border-slate-300">
                                <th>Pirce ID</th>
                                <th>Crop Category</th>
                                <th>Crop Name</th>
                                <th>Variety Name</th>
                                <th>Min Price</th>
                                <th>Max Price</th>
                                <th>Date</th>
                            </tr>
                        <thead>
                        <tbody class="border-separate border-spacing-x-3">
                            <?php
                                require('db_conn.php');
                                if(isset($_POST['Prevoiuse_control_price_rep_genarate'])){
                                    $crop_category = $_POST['crop_category'];
                                    $crop_name = $_POST['crop_name'];
                                    $start_date = $_POST['start_date_control_price'];
                                    $end_date = $_POST['end_date_control_price'];

                                    if(!empty(trim($crop_category)) && !empty(trim($crop_name)) && !empty(trim($start_date)) && !empty(trim($end_date))){

                                        if($crop_category == "Vegetable" || $crop_category == "Fruit"){
                                            $select = "SELECT * FROM controlprice WHERE crop_category = '$crop_category' AND crop_name = '$crop_name' AND DATE(create_date) BETWEEN '$start_date' AND '$end_date'";
                                        }
                                        else if($crop_category == "all"){
                                            $select = "SELECT * FROM controlprice WHERE crop_name = '$crop_name' AND DATE(create_date) BETWEEN '$start_date' AND '$end_date'";
                                        }
                                        $query_run = mysqli_query($conn, $select);
                                        
                                        if(mysqli_num_rows($query_run) >  0){
                                    
                                            while($row = $query_run->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['price_id']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_category']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['varieties_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['pervious_min_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['pervious_max_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['create_date']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                        else{
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                            
                                    }else if(!empty(trim($crop_category)) && empty(trim($crop_name)) && !empty(trim($start_date)) && !empty(trim($end_date))){
                                        
                                        if($crop_category == "Vegetable" || $crop_category == "Fruit"){
                                            $select = "SELECT * FROM controlprice WHERE crop_category = '$crop_category' AND DATE(create_date) BETWEEN '$start_date' AND '$end_date'";
                                        }
                                        else if($crop_category == "all"){
                                            $select = "SELECT * FROM controlprice WHERE DATE(create_date) BETWEEN '$start_date' AND '$end_date'";
                                        }
                                        $query_run = mysqli_query($conn, $select);
                                        
                                        if(mysqli_num_rows($query_run) >  0){
                                    
                                            while($row = $query_run->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['price_id']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_category']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['varieties_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['pervious_min_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['pervious_max_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['create_date']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                        
                                    }else if(!empty(trim($crop_category)) && !empty(trim($crop_name)) && empty(trim($start_date)) && empty(trim($end_date))){
                                        
                                        if($crop_category == "Vegetable" || $crop_category == "Fruit"){
                                            $select = "SELECT * FROM controlprice WHERE crop_category = '$crop_category' AND crop_name = '$crop_name'";
                                        }
                                        else if($crop_category == "all"){
                                            $select = "SELECT * FROM controlprice WHERE crop_name = '$crop_name'";
                                        }
                                        $query_run = mysqli_query($conn, $select);
                                        
                                        if(mysqli_num_rows($query_run) >  0){
                                    
                                            while($row = $query_run->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['price_id']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_category']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['varieties_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['pervious_min_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['pervious_max_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['create_date']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                    }else if(!empty(trim($crop_category)) && !empty(trim($crop_name)) && empty(trim($start_date)) && !empty(trim($end_date))){
                                        
                                        if($crop_category == "Vegetable" || $crop_category == "Fruit"){
                                            $select = "SELECT * FROM controlprice WHERE crop_category = '$crop_category' AND crop_name = '$crop_name' AND DATE(create_date) <= '$end_date'";
                                        }
                                        else if($crop_category == "all"){
                                            $select = "SELECT * FROM controlprice WHERE crop_name = '$crop_name' AND DATE(create_date) <= '$end_date'";
                                        }
                                        $query_run = mysqli_query($conn, $select);
                                        
                                        if(mysqli_num_rows($query_run) >  0){
                                    
                                            while($row = $query_run->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['price_id']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_category']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['varieties_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['pervious_min_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['pervious_max_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['create_date']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                    }else if(!empty(trim($crop_category)) && empty(trim($crop_name)) && empty(trim($start_date)) && !empty(trim($end_date))){
                                        
                                        if($crop_category == "Vegetable" || $crop_category == "Fruit"){
                                            $select = "SELECT * FROM controlprice WHERE crop_category = '$crop_category' AND DATE(create_date) <= '$end_date'";
                                        }
                                        else if($crop_category == "all"){
                                            $select = "SELECT * FROM controlprice WHERE DATE(create_date) <= '$end_date'";
                                        }
                                        $query_run = mysqli_query($conn, $select);
                                        
                                        if(mysqli_num_rows($query_run) >  0){
                                    
                                            while($row = $query_run->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['price_id']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_category']; ?></td>
                                                        <td class="text-center"><?php echo $row['crop_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['varieties_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['pervious_min_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['pervious_max_price']; ?></td>
                                                        <td class="text-center"><?php echo $row['create_date']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                        
                                    }
                                }
                            ?>
                        </tbody>
                    </table>

                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-4 text-center">
                    <button type="button" id="previouse_close_control_price_rep" class="w-24 transition rounded-lg h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                </div>
                
            </form>

        </div>

    </div>

    <!-- control price report generate  -->
    <?php
         
        if(isset($_POST['control_price_rep_genarate'])){
            unset($_POST['control_price_rep_genarate']);
            echo '<script>
            document.getElementById("control_input").style.display = "none";
            document.getElementById("control_price_report").style.display = "block";
            </script>';
        }
        if(isset($_POST['Prevoiuse_control_price_rep_genarate'])){
            unset($_POST['Prevoiuse_control_price_rep_genarate']);
            echo '<script>
            document.getElementById("control_input").style.display = "none";
            document.getElementById("previouse_control_price_report").style.display = "block";
            </script>';
        }
    ?>


    <!-- load side menu bar  -->
    <script>
        $(document).ready(function(){
            $('.load_data_container').load('sendcode/adminpanel.php');
        })
    </script>

    <!-- Fetch crop names on page load -->
    <script>
        $(document).ready(function() {
            // Fetch crop names on page load
            $.ajax({
                url: 'getData.php',
                method: 'POST',
                data: { action: 'fetch_control_crop_names' },
                success: function(data) {
                    $('#crop_name').html(data);
                }
            });

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Control price report generate close and generate buttons handle
            const control_input = document.getElementById("control_input");
            const control_price_report = document.getElementById("control_price_report");
            const previouse_control_price_report = document.getElementById("previouse_control_price_report");
            const control_price_report_btn = document.getElementById("control_price_report_btn");
            const previuse_control_price_report_btn = document.getElementById("previuse_control_price_report_btn");
            const close_control_price = document.getElementById("close_control_price");
            const close_control_price_rep = document.getElementById("close_control_price_rep");
            const previouse_close_control_price_rep = document.getElementById("previouse_close_control_price_rep");

            // All control price report generate close and generate buttons handle
            control_price_report_btn.addEventListener("click", function() {
                control_input.style.display = "block";
                control_input.style.display = "flex";
                control_input.style.alignItems = "center";  
                control_input.style.justifyContent = "center";
                document.getElementById('Prevoiuse_control_price_rep_genarate').style.display = "none";
                document.getElementById('control_price_rep_genarate').style.display = "block";
                const EndDateInput = document.getElementById('end_date_control_price');
                const currentDate = new Date();
                EndDateInput.valueAsDate = new Date();
            });

            previuse_control_price_report_btn.addEventListener("click", function() {
                control_input.style.display = "block";
                control_input.style.display = "flex";
                control_input.style.alignItems = "center";  
                control_input.style.justifyContent = "center";
                document.getElementById('control_price_rep_genarate').style.display = "none";
                document.getElementById('Prevoiuse_control_price_rep_genarate').style.display = "block";
                const EndDateInput = document.getElementById('end_date_control_price');
                const currentDate = new Date();
                EndDateInput.valueAsDate = new Date();
            });


            close_control_price.onclick = function() {
                control_input.style.display = "none";
            }

            close_control_price_rep.onclick = function() {
                control_price_report.style.display = "none";
            }

            previouse_close_control_price_rep.onclick = function() {
                previouse_control_price_report.style.display = "none";
            }



            
            // All user report generate close and generate buttons handle
            const modal_input = document.getElementById("modal_input");
            const customer_report_btn = document.getElementById("customer_report");
            const supplier_report_btn = document.getElementById("supplier_report");
            const farmer_report_btn = document.getElementById("farmer_report");
            const staff_report_btn = document.getElementById("staff_report");
            
            const close_report_genarate = document.getElementById("close_report_genarate");

            const Report_customer_modal =document.getElementById("Report_customer");

            const close = document.getElementById("close");
            const close_staff_report_btn = document.getElementById("close_staff_report_btn");
            close_staff_report_btn.onclick = function() {
                document.getElementById('Report_staff').style.display = "none";
            }

            const closeSupplierBtn = document.getElementById("close_supplier_report_btn");
            if (closeSupplierBtn) {
                closeSupplierBtn.onclick = function () {
                    const supplierModal = document.getElementById("Report_supplier");
                    if (supplierModal) {
                        supplierModal.style.display = "none";
                    }
                };
            }

            const closeFarmerBtn = document.getElementById("close_farmer_report_btn");
            if (closeFarmerBtn) {
                closeFarmerBtn.onclick = function () {
                    const farmerModal = document.getElementById("Report_farmer");
                    if (farmerModal) {
                        farmerModal.style.display = "none";
                    }
                };
            }

            function centerModal() {
                modal_input.style.display = "block"; // After modal show set modal attribute again
                modal_input.style.display = "flex";
                modal_input.style.alignItems = "center";  // Use camelCase for 'align-items'
                modal_input.style.justifyContent = "center";  // Use camelCase for 'justify-content'
                const EndDateInput = document.getElementById('end_date');
                const currentDate = new Date();
                EndDateInput.valueAsDate = new Date();
            }

            customer_report_btn.addEventListener("click", function() {
                document.getElementById('user_type').value = "customer";
                centerModal();
            });

            supplier_report_btn.addEventListener("click", function() {
                document.getElementById('user_type').value = "supplier";
                centerModal();
            });

            farmer_report_btn.addEventListener("click", function() {
                document.getElementById('user_type').value = "farmer";
                centerModal();
            });

            staff_report_btn.onclick = function() {
                document.getElementById('Report_staff').style.display = "block";
            }

            // When the user clicks on the close button (span), close the modal
            close_report_genarate.onclick = function() {
                modal_input.style.display = "none";
            }

            close.onclick = function() {
                Report_customer_modal.style.display = "none";
            }
            


        });
    </script>

</body>
</html>