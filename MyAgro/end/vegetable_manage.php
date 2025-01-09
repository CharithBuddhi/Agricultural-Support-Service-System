<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- pdf convert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Order History</title>
    <style>
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

<body class="select-none">

    <?php require('user_header.php'); ?>

    <div id="" class="w-screen h-screen">
        
        <div class="flex bg-white">

            <div class="w-full mt-8">

                <h1 id="" class="h-8 mb-1 ml-10 font-serif text-3xl font-bold w-fit">Product Manage</h1>

                <div class="flex justify-end h-10 mb-1 ml-10 mr-28">
                    <button id="add_vegetable_btn" data-bs-toggle="modal" data-bs-target="#vegetable_add_modal" class="w-[140px] p-1 text-xl text-white rounded-lg bg-slate-800 hover:bg-slate-500">Add Product</button>
                </div>

                <div class="flex h-10 gap-4 ml-10 text-xl text-white mr-28 bg-slate-800 justify-evenly mb-7">
                    <button id="available" class=" w-[350px] hover:bg-slate-400">Available Products</button>
                    <button id="unavailable" class=" w-[350px] hover:bg-slate-400">Unavailable Products</button>
                    <button id="completed" class=" w-[350px] hover:bg-slate-400">Completed Orders</button>
                    <button id="canceled" class=" w-[350px] hover:bg-slate-400">Canceled Orders</button>
                </div>

                <!-- cancaled orders modal -->
                <div id="canceled_orders" class="flex flex-wrap mr-12" style="display: none;">

                    <?php 
                        include('db_connect.php');
                        $user_id = $_SESSION['login_id'];
                        $user_type1 = $_SESSION['login_type'];   
                        $sql = "SELECT * FROM transaction WHERE provider_id = '$user_id' AND provider_type = '$user_type1' AND payment_status = 'Canceled' ORDER BY (LENGTH(customer_name) < 25) DESC, LENGTH(customer_name) DESC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                            ?>                    
                                <form class="flex flex-col ml-10 mb-6 gap-1 p-3 w-[350px] border-l-2 border-b-2 border-slate-200  rounded-lg shadow-2xl">
                                    
                                    <div class="flex flex-col items-center gap-1">
                                        <label id="product_name" class="text-xl font-bold text-center"> <?php echo ucfirst($row['item_name']); ?></label>
                                        <label id="product_category" class="font-medium"> <?php echo ucfirst($row['item_category']); ?></label>
                                    </div>
                                    
                                    <label id="product_id" hidden> <?php echo $row['item_id']; ?></label>
                                    <label id="product_price" class="font-medium" hidden> <?php echo $row['item_price']; ?></label>
                                    <label id="product_quantity" class="font-medium" hidden> <?php echo $row['item_quantity']; ?></label>

                                    <label id="location" hidden><?php echo $row['item_location']; ?></label>

                                    <label id="provider_id" hidden><?php echo $row['provider_id']; ?></label>

                                    <label id="provider_name" hidden><?php echo $row['provider_name']; ?></label>

                                    <label id="provider_phone" hidden><?php echo $row['provider_phone']; ?></label>

                                    <label id="provider_email" hidden><?php echo $row['provider_email']; ?></label>

                                    <label id="product_price" hidden><?php echo "Rs. ".$row['item_price']; ?></label>

                                    <p class="flex gap-1 mt-4">
                                        <label class="font-medium">Order Quantity:</label>
                                        <label id="order_quantity"><?php echo $row['order_quantity']; ?></label>
                                        <label id="meassure"><?php echo $row['meassure']; ?></label>
                                    </p>

                                    <p>
                                        <label class="font-medium">Paid Amount:</label>
                                        <label id="paid_amount">
                                            <?php 
                                                if($row['paid_amount'] == ""){
                                                    ?>
                                                    <label class="font-medium">Not paid</label>
                                                    <?php
                                                }else{
                                                    echo "Rs. ".$row['paid_amount'];
                                            } ?>
                                        </label>
                                    </p>

                                    <p>
                                        <label class="font-medium">Toatal Amount:</label>
                                        <label id="total_amount"><?php echo "Rs. ".$row['total_amount']; ?></label>
                                    </p>

                                    <p>
                                        <label class="font-medium">Order Date:</label>
                                        <label id="order_date"><?php echo $row['created']; ?></label>
                                    </p>
                                    
                                    <p class="flex gap-1 mt-4">
                                        <label class="pl-0.5 font-medium">Customer ID :</label>
                                        <label id="customer_id"><?php echo $row['customer_id']; ?></label>
                                    </p>

                                    <p class="">
                                        <label class="font-medium">Customer Name:</label> 
                                        <label id="customer_name"><?php echo ucfirst($row['customer_name']); ?></label>
                                    </p>

                                    <p class="">
                                        <label class="font-medium">Customer Email:</label> 
                                        <label id="customer_email"><?php echo $row['customer_email']; ?></label>
                                    </p>
                                    
                                    <p id="payment_status" class="pl-2 pr-2 pt-0.5 pb-0.5 mt-1 mb-1 font-bold text-white bg-red-500 rounded-lg w-fit">Cancelled</p>
                                            
                                    <div class="flex gap-1 mt-1">

                                        <button type="button" id="Invoice_Btn" value="<?php echo $row['Reference_id']; ?>" class="Invoice_Btn pl-4 pr-4 pt-0.5 pb-0.5 mb-1 font-bold text-white rounded-md bg-slate-800">
                                            Invoice
                                            <i class="ml-1 fa-solid fa-file-pdf"></i>
                                        </button>

                                    </div>
                                    
                                </form>

                                <?php
                            }
                            
                        }else {
                            ?>
                                <h1 class="w-full mt-20 text-4xl font-semibold text-center">You have not cancalled orders yet</h1>
                            <?php
                        }

                    ?>

                </div>

                <!-- completed orders modal -->
                <div id="completed_orders" class="flex flex-wrap mr-12" style="display: none;">

                    <?php 
                        include('db_connect.php');
                        $user_id = $_SESSION['login_id'];
                        $user_type = $_SESSION['login_type'];

                        $sql = "SELECT * FROM transaction WHERE provider_id = '$user_id' AND provider_type = '$user_type' AND payment_status = 'Completed'  ORDER BY  (LENGTH(customer_email) < 23) DESC, LENGTH(customer_email) DESC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                            ?> 

                                <form class="flex flex-col ml-10 mb-6 gap-1 p-3 w-[350px] border-l-2 border-b-2 border-slate-200  rounded-lg shadow-2xl">
                                    
                                    <div class="flex flex-col items-center gap-1">
                                        <label id="product_name" class="text-xl font-bold text-center"> <?php echo ucfirst($row['item_name']); ?></label>
                                        <label id="product_category" class="font-medium"> <?php echo ucfirst($row['item_category']); ?></label>
                                    </div>
                                    
                                    <label id="product_id" hidden> <?php echo $row['item_id']; ?></label>
                                    <label id="product_price" class="font-medium" hidden> <?php echo $row['item_price']; ?></label>
                                    <label id="product_quantity" class="font-medium" hidden> <?php echo $row['item_quantity']; ?></label>

                                    <label id="location" hidden><?php echo $row['item_location']; ?></label>

                                    <label id="provider_id" hidden><?php echo $row['provider_id']; ?></label>

                                    <label id="provider_name" hidden><?php echo $row['provider_name']; ?></label>

                                    <label id="provider_phone" hidden><?php echo $row['provider_phone']; ?></label>

                                    <label id="provider_email" hidden><?php echo $row['provider_email']; ?></label>

                                    <label id="product_price" hidden><?php echo "Rs. ".$row['item_price']; ?></label>

                                    <p class="flex gap-1 mt-4">
                                        <label class="font-medium">Order Quantity:</label>
                                        <label id="order_quantity"><?php echo $row['order_quantity']; ?></label>
                                        <label id="meassure"><?php echo $row['meassure']; ?></label>
                                    </p>

                                    <p>
                                        <label class="font-medium">Paid Amount :</label>
                                        <label id="paid_amount">
                                            <?php 
                                                if($row['paid_amount'] == ""){
                                                    ?>
                                                    <label class="font-medium">Not paid</label>
                                                    <?php
                                                }else{
                                                    echo "Rs. ".$row['paid_amount'];
                                            } ?>
                                        </label>
                                    </p>

                                    <p>
                                        <label class="font-medium">Toatal Amount:</label>
                                        <label id="total_amount"><?php echo "Rs. ".$row['total_amount']; ?></label>
                                    </p>

                                    <p>
                                        <label class="font-medium">Order Date:</label>
                                        <label id="order_date"><?php echo $row['created']; ?></label>
                                    </p>
                                    
                                    <p class="flex gap-1 mt-4">
                                        <label class="pl-0.5 font-medium">Customer ID :</label>
                                        <label id="customer_id"><?php echo $row['customer_id']; ?></label>
                                    </p>

                                    <p class="">
                                        <label class="font-medium">Customer Name:</label> 
                                        <label id="customer_name"><?php echo ucfirst($row['customer_name']); ?></label>
                                    </p>

                                    <p class="">
                                        <label class="font-medium">Customer Email:</label> 
                                        <label id="customer_email"><?php echo $row['customer_email']; ?></label>
                                    </p>
                                    
                                    <!-- <label  hidden>Cancelled</label> -->
                                    <p id="payment_status" class="pl-2 pr-2 pt-0.5 pb-0.5 mt-1 mb-1 font-bold text-white bg-green-500 rounded-lg w-fit">Completed</p>
                                            
                                    <div class="flex gap-1 mt-1">

                                        <button type="button" id="Invoice_Btn" value="<?php echo $row['Reference_id']; ?>" class="Invoice_Btn pl-4 pr-4 pt-0.5 pb-0.5 mb-1 font-bold text-white rounded-md bg-slate-800">
                                            Invoice
                                            <i class="ml-1 fa-solid fa-file-pdf"></i>
                                        </button>

                                    </div>
                                    
                                </form>
                        
                            <?php

                            }

                        }else {
                            
                            ?>
                                <h1 class="w-full mt-20 text-4xl font-semibold text-center">You have no completed orders yet</h1>
                            <?php
                        }
                        
                        
                    ?>

                </div>

                <!-- available_products modal -->
                <div id="available_products" class="flex flex-wrap mr-12">

                    <?php 
                        include('db_connect.php');
                        $user_id = $_SESSION['login_id'];
                        $user_type = $_SESSION['login_type'];

                        $sql = "SELECT * FROM vegetablefruit WHERE farmer_id = '$user_id' AND vegfruit_total > 0  ORDER BY (LENGTH(vegfruit_location) > 25) DESC, LENGTH(vegfruit_location) DESC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                            ?> 
                            <form class="flex flex-col ml-10 mb-6 gap-1 pb-2 w-[350px] border-l-2 border-b-2 border-slate-200  rounded-lg shadow-2xl">
                                
                                <div class="flex flex-col items-center gap-1">
                                    <label id="vegfruitle_id" hidden> <?php echo $row['vegfruitle_id']; ?></label>
                                    <label class="text-xl font-bold text-center"> <?php echo ucfirst($row['vegfruitle_verity']); ?></label>
                                    <label class="font-medium"> <?php echo ucfirst($row['vegetable_category']); ?></label>

                                    <label id="vegfruitle_verity" hidden> <?php echo $row['vegfruitle_verity']; ?></label>
                                    <label id="vegetable_category" hidden> <?php echo $row['vegetable_category']; ?></label>
                                </div>

                                <label id="vegfruit_distric" hidden><?php echo $row['vegfruit_distric']; ?></label>
                                <label id="vegfruit_area" hidden><?php echo $row['vegfruit_area']; ?></label>

                                <div class="flex justify-center">
                                    <img class="w-[180px] h-[150px] py-1 rounded-lg" src="images/vegetable/<?php echo $row['vegfruit_image']; ?>" alt="fertilizer">
                                    <label id="vegfruit_image" hidden><?php echo $row['vegfruit_image']; ?></label>
                                </div>

                                <div class="flex justify-center mt-2">
                                    <label class="font-medium"><?php echo ucfirst($row['vegetable_name']); ?></label>
                                    
                                    <label id="vegetable_name" hidden><?php echo $row['vegetable_name']; ?></label>
                                </div>

                                <div class="flex flex-col gap-1 px-2.5 mt-2 place-self-start">

                                    <div> 
                                        <label class="font-bold">Product Price : </label>
                                        <label>Rs.<label id="vegfruit_price"><?php echo $row['vegfruit_price']; ?></label></label> 
                                    </div>

                                    <div>
                                        <label class="font-bold">Total Quantity :</label>
                                        <label id="vegfruit_total"><?php echo $row['vegfruit_total']; ?></label>
                                        <label  id="">Kg</label>
                                    </div>

                                    <div>
                                        <label class="font-bold">Pick up location : </label>
                                        <label id="vegfruit_location"><?php echo $row['vegfruit_location']; ?></label>
                                    </div>

                                    <div>
                                        <label class="font-bold">Pick up District and area : </label>
                                        <label id=""><?php echo $row['vegfruit_distric']." - ".$row['vegfruit_area']; ?></label>
                                    </div>
                                    
                                </div>

                                <div class="flex gap-2 mt-3 mr-5 place-self-end">

                                    <button type="button" id="vegetable_delete_btn" value="<?php echo $row['vegfruitle_id']; ?>" class="pt-1 pb-1 pl-2 pr-2 mb-1 font-bold text-white rounded-md vegetable_delete_btn bg-slate-800 hover:bg-slate-600">
                                        Delete
                                    </button>

                                    <button type="button" id="vegetable_update_btn" value="<?php echo $row['vegfruitle_id']; ?>" data-bs-toggle="modal" data-bs-target="#vegetable_update_modal" class="pt-1 pb-1 pl-2 pr-2 mb-1 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-500 vegetable_update_btn">
                                        Update
                                    </button>
                                    
                                </div>
                                
                            </form>
                        
                            <?php

                            }

                        }else {
                            
                            ?>
                                <h1 class="w-full mt-20 text-4xl font-semibold text-center">You havn't any market available products</h1>
                            <?php
                        }
                        
                    ?>

                </div>

                <!-- unavailable_products modal -->
                <div id="unavailable_products" class="flex flex-wrap mr-12" style="display: none;">

                    <?php 
                        include('db_connect.php');
                        $user_id = $_SESSION['login_id'];
                        $user_type = $_SESSION['login_type'];

                        $sql = "SELECT * FROM vegetablefruit WHERE farmer_id = '$user_id' AND vegfruit_total = 0  ORDER BY (LENGTH(vegfruit_location) > 25) DESC, LENGTH(vegfruit_location) DESC";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                            ?> 
                                <form class="flex flex-col ml-10 mb-6 gap-1 pb-2 w-[350px] border-l-2 border-b-2 border-slate-200  rounded-lg shadow-2xl">
                                    
                                    <div class="flex flex-col items-center gap-1">
                                        <label id="vegfruitle_id" hidden> <?php echo $row['vegfruitle_id']; ?></label>
                                        <label class="text-xl font-bold text-center"> <?php echo ucfirst($row['vegfruitle_verity']); ?></label>
                                        <label class="font-medium"> <?php echo ucfirst($row['vegetable_category']); ?></label>

                                        <label id="vegfruitle_verity" hidden> <?php echo $row['vegfruitle_verity']; ?></label>
                                        <label id="vegetable_category" hidden> <?php echo $row['vegetable_category']; ?></label>
                                    </div>

                                    <label id="vegfruit_distric" hidden><?php echo $row['vegfruit_distric']; ?></label>
                                    <label id="vegfruit_area" hidden><?php echo $row['vegfruit_area']; ?></label>

                                    <div class="flex justify-center">
                                        <img class="w-[180px] h-[150px] py-1 rounded-lg" src="images/vegetable/<?php echo $row['vegfruit_image']; ?>" alt="fertilizer">
                                        <label id="vegfruit_image" hidden><?php echo $row['vegfruit_image']; ?></label>
                                    </div>

                                    <div class="flex justify-center mt-2">
                                        <label class="font-medium"><?php echo ucfirst($row['vegetable_name']); ?></label>
                                        
                                        <label id="vegetable_name" hidden><?php echo $row['vegetable_name']; ?></label>
                                    </div>

                                    <div class="flex flex-col gap-1 px-2.5 mt-2 place-self-start">

                                        <div> 
                                            <label class="font-bold">Product Price : </label>
                                            <label>Rs.<label id="vegfruit_price"><?php echo $row['vegfruit_price']; ?></label></label> 
                                        </div>

                                        <div>
                                            <label class="font-bold">Total Quantity :</label>
                                            <label id="vegfruit_total"><?php echo $row['vegfruit_total']; ?></label>
                                            <label  id="">Kg</label>
                                        </div>

                                        <div>
                                            <label class="font-bold">Pick up location : </label>
                                            <label id="vegfruit_location"><?php echo $row['vegfruit_location']; ?></label>
                                        </div>

                                        <div>
                                            <label class="font-bold">Pick up District and area : </label>
                                            <label id=""><?php echo $row['vegfruit_distric']." - ".$row['vegfruit_area']; ?></label>
                                        </div>
                                        
                                    </div>
                                    <div class="flex gap-2 mt-3 mr-5 place-self-end">

                                        <button type="button" id="vegetable_delete_btn" value="<?php echo $row['vegfruitle_id']; ?>" class="pt-1 pb-1 pl-2 pr-2 mb-1 font-bold text-white rounded-md vegetable_delete_btn bg-slate-800 hover:bg-slate-600">
                                        Delete
                                        </button>

                                        <button type="button" id="vegetable_update_btn" value="<?php echo $row['vegfruitle_id']; ?>" data-bs-toggle="modal" data-bs-target="#vegetable_update_modal" class="pt-1 pb-1 pl-2 pr-2 mb-1 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-500 vegetable_update_btn">
                                        Update
                                        </button>
                                        
                                    </div>
                                    
                                </form>
                            <?php
                            }
                        }else {
                            ?>
                                <h1 class="w-full mt-20 text-4xl font-semibold text-center">You havn't any unavailable products</h1>
                            <?php
                        }
                        
                    ?>

                </div>

            </div>
            
        </div>

    </div>


    <!-- Modal for added vegatable view -->
    <div class="modal fade" id="vegetable_add_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl ">
            <div class="absolute text-black modal-content">
                <div class="modal-header">
                    <b><h5 class="modal-title" id="exampleModalLabel">Add new product details</h5></b>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="font_inser.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="flex flex-col ml-4 font-semibold">

                            <!-- Product Info -->
                            <div>
                                <label for="" class="text-2xl italic font-bold border-b-2 border-black">Product Info</label>
                                <div class="grid grid-cols-3 gap-3 mt-2">

                                    <div class="flex flex-col gap-1">
                                        <label for="Product_Origin">Product Origin</label>
                                        <select name="Product_Origin" id="Product_Origin"  class="h-8 border-2 border-black rounded-md w-72" required>
                                            <option value="vegetable">Vegetable</option>
                                            <option value="fruit">Fruit</option>
                                        </select>
                                    </div>

                                    <div id="ferilizer_div" class="flex flex-col gap-1">                                    
                                        <label for="Product_Category">Product Category</label>
                                        <select name="Product_Category" id="Product_Category" class="h-8 border-2 border-black rounded-md w-72" required>
                                            <option value="">Select Category</option>
                                        </select>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <label for="Product_name">Product Name</label>
                                        <select name="Product_name" id="Product_name" class="h-8 border-2 border-black rounded-md w-72" required>
                                            <option value="">Select Name</option>
                                        </select>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <label for="Product_image">Product Image</label>
                                        <input type="file" accept="image/*" id="Product_image" name="Product_image" placeholder="Product name" class="w-72 border-2 h-[30px] border-black rounded-md" required>
                                    </div>
                                    
                                </div>
                            </div>

                            <!-- Selling Info -->
                            <div>
                                <label for="" class="mt-4 text-2xl italic font-bold border-b-2 border-black">Selling Info</label>
                                
                                <div class="flex flex-col mt-1">
                                    <div class="flex gap-1">
                                        <label for="minimum_price"><label class="text-lg text-red-600">*</label>Minimum Price:</label>
                                        <input id="minimum_price" class="outline-none" readonly>
                                    </div>
                                    <div class="flex gap-1">
                                        <label for="maximum_price"><label class="text-lg text-red-600">*</label>Maximum Price:</label>
                                        <input id="maximum_price" class="outline-none" readonly>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-3 gap-3 mt-1">

                                        
                                    <div class="flex flex-col gap-1">
                                        <label for="product_price">Product Price(Kg)</label>
                                        <input type="number" min="" max="" step="0.01" id="product_price" name="product_price" placeholder="450.00" class="h-8 pl-1 border-2 border-black rounded-md w-72" required>
                                    </div>


                                    <div class="flex flex-col gap-1">
                                        <label for="total_quantity">Total Selling Quantity(Kg)</label>
                                        <input type="number" min="1" id="total_quantity" name="total_quantity" placeholder="400" class="h-8 pl-1 border-2 border-black rounded-md w-72" >
                                    </div>
                                    
                                    <div class="flex flex-col gap-1">
                                        <label for="district">District</label>
                                        <select name="district" id="district" class="h-8 border-2 border-black rounded-md w-72" required>
                                            <option value="Ampara">Ampara</option>
                                            <option value="Anuradhapura">Anuradhapura</option>
                                            <option value="Badulla">Badulla</option>
                                            <option value="Batticaloa">Batticaloa</option>
                                            <option value="Colombo">Colombo</option>
                                            <option value="Galle">Galle</option>
                                            <option value="Gampaha">Gampaha</option>
                                            <option value="Hambantota">Hambantota</option>
                                            <option value="Jaffna">Jaffna</option>
                                            <option value="Kalutara">Kalutara</option>
                                            <option value="Kandy">Kandy</option>
                                            <option value="Kegalle">Kegalle</option>
                                            <option value="Kilinochchi">Kilinochchi</option>
                                            <option value="Kurunegala">Kurunegala</option>
                                            <option value="Mannar">Mannar</option>
                                            <option value="Matale">Matale</option>
                                            <option value="Matara">Matara</option>
                                            <option value="Monaragala">Monaragala</option>
                                            <option value="Mullaitivu">Mullaitivu</option>
                                            <option value="Nuwara Eliya">Nuwara Eliya</option>
                                            <option value="Polonnaruwa">Polonnaruwa</option>
                                            <option value="Puttalam">Puttalam</option>
                                            <option value="Ratnapura">Ratnapura</option>
                                            <option value="Trincomalee">Trincomalee</option>
                                            <option value="Vavuniya">Vavuniya</option>
                                        </select>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <label for="area">Mother Town</label>
                                        <input type="text" id="area" name="area" placeholder="Petta" class="h-8 pl-1 border-2 border-black rounded-md w-72" required>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <label for="address">Selling Address</label>
                                        <input type="text" id="address" name="address" placeholder="No 258, Petta Bus Road" class="h-8 pl-1 border-2 border-black rounded-md w-72" required>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="vegetable_submit"  class="w-24 btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for update vegetable view -->
    <div class="modal fade" id="vegetable_update_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl ">
            <div class="absolute text-black modal-content">
                <div class="modal-header">
                    <b><h5 class="modal-title" id="exampleModalLabel">Add new product details</h5></b>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="updatefont.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="flex flex-col ml-4 font-semibold">

                            <!-- Product Info -->
                            <div>
                                <label for="" class="text-2xl italic font-bold border-b-2 border-black">Product Info</label>
                                <div class="grid grid-cols-3 gap-3 mt-2">

                                    <input type="text" id="update_vegfruitle_id" name="update_vegfruitle_id" hidden value="">

                                    <div class="flex flex-col gap-1">
                                        <label for="update_product_category">Product Origin</label>
                                        <select name="update_product_category" id="update_product_category"  class="h-8 border-2 border-black rounded-md w-72" required>
                                            <option value="vegetable">Vegetable</option>
                                            <option value="fruit">Fruit</option>
                                        </select>
                                    </div>

                                    <div id="ferilizer_div" class="flex flex-col gap-1">                                    
                                        <label for="update_product_name">Product Category</label>
                                        <select name="update_product_name" id="update_product_name" class="h-8 border-2 border-black rounded-md w-72" required>
                                            <option value="">Select Category</option>
                                        </select>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <label for="update_product_variety">Product Name</label>
                                        <select name="update_product_variety" id="update_product_variety" class="h-8 border-2 border-black rounded-md w-72" required>
                                            <option value="">Select Name</option>
                                        </select>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <label for="Product_image">Product Image</label>
                                        <input type="file" accept="image/*" id="update_product_image" name="update_product_image" class="w-72 border-2 h-[30px] border-black rounded-md">
                                        <img src="" id="preview_product_image"  class="w-72 border-2 h-[110px] border-black rounded-md">
                                    </div>
                                    
                                    
                                </div>
                            </div>

                            <!-- Selling Info -->
                            <div>
                                <label for="" class="mt-4 text-2xl italic font-bold border-b-2 border-black">Selling Info</label>
                                
                                <div class="flex flex-col mt-1">
                                    <div class="flex gap-1">
                                        <label for="update_minimum_price"><label class="text-lg text-red-600">*</label>Minimum Price:</label>
                                        <input id="update_minimum_price" class="outline-none" readonly>
                                    </div>
                                    <div class="flex gap-1">
                                        <label for="update_maximum_price"><label class="text-lg text-red-600">*</label>Maximum Price:</label>
                                        <input id="update_maximum_price" class="outline-none" readonly>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-3 gap-3 mt-1">

                                        
                                    <div class="flex flex-col gap-1">
                                        <label for="update_product_price">Product Price(Kg)</label>
                                        <input type="number" min="" max="" step="0.01" id="update_product_price" name="update_product_price" placeholder="450.00" class="h-8 pl-1 border-2 border-black rounded-md w-72" required>
                                    </div>


                                    <div class="flex flex-col gap-1">
                                        <label for="update_total_quantity">Total Selling Quantity(Kg)</label>
                                        <input type="number" min="1" id="update_total_quantity" name="update_total_quantity" placeholder="400" class="h-8 pl-1 border-2 border-black rounded-md w-72" >
                                    </div>
                                    
                                    <div class="flex flex-col gap-1">
                                        <label for="update_district">District</label>
                                        <select name="update_district" id="update_district" class="h-8 border-2 border-black rounded-md w-72" required>
                                            <option value="Ampara">Ampara</option>
                                            <option value="Anuradhapura">Anuradhapura</option>
                                            <option value="Badulla">Badulla</option>
                                            <option value="Batticaloa">Batticaloa</option>
                                            <option value="Colombo">Colombo</option>
                                            <option value="Galle">Galle</option>
                                            <option value="Gampaha">Gampaha</option>
                                            <option value="Hambantota">Hambantota</option>
                                            <option value="Jaffna">Jaffna</option>
                                            <option value="Kalutara">Kalutara</option>
                                            <option value="Kandy">Kandy</option>
                                            <option value="Kegalle">Kegalle</option>
                                            <option value="Kilinochchi">Kilinochchi</option>
                                            <option value="Kurunegala">Kurunegala</option>
                                            <option value="Mannar">Mannar</option>
                                            <option value="Matale">Matale</option>
                                            <option value="Matara">Matara</option>
                                            <option value="Monaragala">Monaragala</option>
                                            <option value="Mullaitivu">Mullaitivu</option>
                                            <option value="Nuwara Eliya">Nuwara Eliya</option>
                                            <option value="Polonnaruwa">Polonnaruwa</option>
                                            <option value="Puttalam">Puttalam</option>
                                            <option value="Ratnapura">Ratnapura</option>
                                            <option value="Trincomalee">Trincomalee</option>
                                            <option value="Vavuniya">Vavuniya</option>
                                        </select>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <label for="area">Mother Town</label>
                                        <input type="text" id="update_area" name="update_area" placeholder="Petta" class="h-8 pl-1 border-2 border-black rounded-md w-72" required>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <label for="address">Selling Address</label>
                                        <input type="text" id="update_address" name="update_address" placeholder="No 258, Petta Bus Road" class="h-8 pl-1 border-2 border-black rounded-md w-72" required>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="vegetable_update" class="w-24 btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Delete function run here -->
    <script src="javascript/delete.js"></script>

    <!-- view available unavailable products and completed canceled orders  -->
    <!-- chanage button color after selected -->
    <script>
        // Get button elements
        const buttons = document.querySelectorAll("#canceled, #completed, #available, #unavailable");

        // Get content elements
        const canceled_orders = document.getElementById("canceled_orders");
        const completed_orders = document.getElementById("completed_orders");
        const available_products = document.getElementById("available_products");
        const unavailable_products = document.getElementById("unavailable_products");

        // Function to handle button clicks
        function handleButtonClick(activeButtonId) {

            // Reset all buttons and content
            buttons.forEach((btn) => btn.classList.remove("active"));
            canceled_orders.style.display = "none";
            completed_orders.style.display = "none";
            available_products.style.display = "none";
            unavailable_products.style.display = "none";

            // Set the active button and show corresponding content
            document.getElementById(activeButtonId).classList.add("active");

            switch (activeButtonId) {
                case "canceled":
                    canceled_orders.style.display = "flex";
                    break;
                case "completed":
                    completed_orders.style.display = "flex";
                    break;
                case "available":
                    available_products.style.display = "flex";
                    break;
                case "unavailable":
                    unavailable_products.style.display = "flex";
                    break;
            }
        }

        // Attach event listeners to buttons
        buttons.forEach((btn) => {
            btn.addEventListener("click", () => handleButtonClick(btn.id));
        });
    </script>

    <!-- Fetch crop names on page load and change based on origin with ADD-->
    <script>
        $(document).ready(function() {

            // Fetch crop names on page load using origin
            var origin = $('#Product_Origin').val();
            $.ajax({
                url: 'get_vegetables_data.php',
                method: 'POST',
                data: { action: 'fetch_crop_names', origin: origin },
                success: function(data) {
                    $('#Product_Category').html(data);
                }
            });

            // Fetch crop names based on selected origin
            $('#Product_Origin').change(function() {
                var origin = $(this).val();
                $.ajax({
                    url: 'get_vegetables_data.php',
                    method: 'POST',
                    data: { action: 'fetch_crop_names', origin: origin },
                    success: function(data) {
                        $('#Product_Category').html(data);
                    }
                });
            });

            // Fetch crop varieties based on selected crop name
            $('#Product_Category').change(function() {
                
                var origin = $('#Product_Origin').val();
                var Category = $(this).val();
                $.ajax({
                    url: 'get_vegetables_data.php',
                    method: 'POST',
                    data: { action: 'fetch_crop_varieties', Category: Category , origin: origin },
                    success: function(data) {
                        
                        // getting out put displya this id element
                        $('#Product_name').html(data);
                    }
                });
            });

            // Fetch Minimum and Mximum price based on selected crop name
            $('#Product_name').change(function() {
                
                var origin = $('#Product_Origin').val();
                var category = $('#Product_Category').val();
                var name = $(this).val();
                $.ajax({
                    url: 'get_vegetables_data.php',
                    method: 'POST',
                    data: { action: 'fetch_crop_minimum and maxmum price',
                            origin: origin , 
                            category: category , 
                            name: name },
                    success: function(data) {
                        
                        // Set values in the input fields
                        $('#minimum_price').val(data.min_price);
                        $('#maximum_price').val(data.max_price);
                        
                        // Set min and max attributes for the Product_price input field
                        $('#product_price').attr('min', data.min_price);
                        $('#product_price').attr('max', data.max_price);
                        
                    },error: function(xhr, status, error) {
                            console.error("Error fetching data:", error);
                    }
                });
            });

        });
    </script>

    <!-- generate pdf -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            const Invoice_Button = document.querySelectorAll(".Invoice_Btn");

            function generatePDF(content) {
                // Generate PDF from the virtual element content
                const virtualElement = document.createElement('div');
                virtualElement.innerHTML = content;
                
                const options = {
                    margin: 0.1,
                    filename: 'order_invoice.pdf',
                    image: { type: 'jpeg', quality: 1.0 },  // Sets high-quality JPEG images
                    html2canvas: { scale: 3 },  // Increases the scale for better resolution
                    jsPDF: { unit: 'in', format: 'a5', orientation: 'portrait' }
                };
                html2pdf().set(options).from(virtualElement).save();

            }

            // Iterate through each button and add a click event listener
            Invoice_Button.forEach(button => {
                button.addEventListener("click", function() {
                    
                let form = this.closest('form');

                // Retrieve the values you need
                let paymentStatus = form.querySelector('#payment_status')?.innerText || "N/A";
                let orderQuantity = form.querySelector('#order_quantity')?.innerText || "N/A";
                let paidAmount = form.querySelector('#paid_amount')?.innerText || "Not paid";
                let totalAmount = form.querySelector('#total_amount')?.innerText || "N/A";
                let location = form.querySelector('#location')?.innerText || "N/A";
                let orderDate = form.querySelector('#order_date')?.innerText || "N/A";

                let productName = form.querySelector('#product_name')?.innerText || "N/A";
                let productCategory = form.querySelector('#product_category')?.innerText || "N/A";
                let productPrice = form.querySelector('#product_price')?.innerText || "N/A";
                let productQuantity = form.querySelector('#product_quantity')?.innerText || "N/A";

                let customerName = form.querySelector('#customer_name')?.innerText || "N/A";
                let customerEmail = form.querySelector('#customer_email')?.innerText || "N/A";

                let providerName = form.querySelector('#provider_name')?.innerText || "N/A";
                let providerPhone = form.querySelector('#provider_phone')?.innerText || "N/A";
                let providerEmail = form.querySelector('#provider_email')?.innerText || "N/A";

                // Set the content for virtualElement with the values dynamically
                const pdfContent = `
                    <div class="flex items-center justify-center">
                        <div class=" w-[500px]">
                            <div class="flex flex-col gap-2">

                                <h1 class="mt-2 font-serif text-2xl font-bold text-center">MyAgro</h1>
                                
                                <div class="flex">
                                    
                                    <!-- Set paymentStatus to "Pending" if it is "succeeded" -->
                                    <p class="ml-1 text-lg font-bold" style="color: 
                                        ${
                                            (paymentStatus === "Completed")
                                                ? "#46d82f"
                                            :"#ff0000"
                                        }">
                                        ${paymentStatus}
                                    </p>
                                </div>

                                <div class="flex flex-col w-full gap-1 pt-2 pl-2 border-2 rounded-xl">
                                    <h4 class="text-lg font-bold">Payment Information</h4>
                                    <div class="flex gap-1"><p class="font-medium">Order Quantity:</p><p>${orderQuantity}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Paid Amount:</p><p>${paidAmount}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Total Amount:</p><p>${totalAmount}</p></div>
                                    <div class="flex gap-1 mb-1"><p class="font-medium">Order Date:</p><p>${orderDate}</p></div>
                                </div>

                                <div class="flex flex-col w-full gap-1 pt-2 pl-2 border-2 rounded-xl">
                                    <h4 class="text-lg font-bold">Product Information</h4>
                                    <div class="flex gap-1"><p class="font-medium">Product Name:</p><p>${productName}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Product Category:</p><p>${productCategory}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Product Price:</p><p>${productPrice}</p></div>
                                    <div class="flex gap-1 mb-1"><p class="font-medium">Product Quantity:</p><p>${productQuantity}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Location:</p><p>${location}</p></div>
                                </div>

                                <div class="flex flex-col w-full gap-1 pt-2 pl-2 border-2 rounded-xl">
                                    <h4 class="text-lg font-bold">Customer Information</h4>
                                    <div class="flex gap-1"><p class="font-medium">Customer Name:</p><p>${customerName}</p></div>
                                    <div class="flex gap-1 mb-1"><p class="font-medium">Customer Email:</p><p>${customerEmail}</p></div>
                                </div>

                                <div class="flex flex-col w-full gap-1 pt-2 pl-2 border-2 rounded-xl">
                                    <h4 class="text-lg font-bold">Provider Information</h4>
                                    <div class="flex gap-1"><p class="font-medium">Provider Name:</p><p>${providerName}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Provider Phone:</p><p>${providerPhone}</p></div>
                                    <div class="flex gap-1 mb-1"><p class="font-medium">Provider Email:</p><p>${providerEmail}</p></div>
                                </div>
                                <div class="invoice-footer" style="text-align: center;">
                                    <p class="text-lg font-semibold">Thank you for choosing us!</p>
                                    <p>We appreciate your trust in our services. If you have any questions or need assistance, please don’t hesitate to reach out.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Call the function to generate PDF with the populated content
                generatePDF(pdfContent);
                });
            });

        });

    </script>

    <!-- SET UPDATE MODAL VALUE -->
    <script>
        
        const vegetable_update_btn = document.querySelectorAll('.vegetable_update_btn');
        
        vegetable_update_btn.forEach(button => {
            button.addEventListener("click", function() {

                let form = this.closest('form');

                let vegfruitle_id = form.querySelector('#vegfruitle_id').innerText;
                let vegetable_name = form.querySelector('#vegetable_name').innerText.trim();
                let vegetable_category = form.querySelector('#vegetable_category').innerText.trim();
                let vegfruit_distric = form.querySelector('#vegfruit_distric').innerText.trim();
                let vegfruit_area = form.querySelector('#vegfruit_area').innerText;
                
                let vegfruit_image = form.querySelector('#vegfruit_image').innerText;
                let vegfruit_price = form.querySelector('#vegfruit_price').innerText;
                let vegfruit_total = form.querySelector('#vegfruit_total').innerText;
                let vegfruit_location = form.querySelector('#vegfruit_location').innerText;
                
                let imagePath = "http://localhost/Agricultural-Support-Service-System/MyAgro/end/images/vegetable/" + vegfruit_image;

                document.getElementById('update_vegfruitle_id').value = vegfruitle_id;
                
                let update_product_category = document.getElementById('update_product_category');
                update_product_category.value = vegetable_category;

                let update_product_name = document.getElementById('update_product_name');
                update_product_name.value = vegetable_name;
                
                // Set the src of the image preview to the file path from the database
                document.getElementById('preview_product_image').src = imagePath;
                
                document.getElementById('update_district').value = vegfruit_distric;
                document.getElementById('update_area').value = vegfruit_area;
                document.getElementById('update_address').value = vegfruit_location;

                document.getElementById('update_product_price').value = vegfruit_price;
                document.getElementById('update_total_quantity').value = vegfruit_total;
                           

            });
        });

        // Fetch crop names on page load and change based on origin  with UPDATE modal
        $(document).ready(function() {

            // Fetch crop names on page load using origin
            var origin = $('#update_product_category').val();
            $.ajax({
                url: 'get_vegetables_data.php',
                method: 'POST',
                data: { action: 'fetch_crop_names', origin: origin },
                success: function(data) {
                    $('#update_product_name').html(data);
                }
            });

            // Fetch crop names based on change origin
            $('#update_product_category').change(function() {
                var origin = $(this).val();
                $.ajax({
                    url: 'get_vegetables_data.php',
                    method: 'POST',
                    data: { action: 'fetch_crop_names', origin: origin },
                    success: function(data) {
                        $('#update_product_name').html(data);
                    }
                });
            });

            // Fetch crop varieties based on change crop name
            $('#update_product_name').change(function() {
                
                var origin = $('#update_product_category').val();
                var Category = $(this).val();
                $.ajax({
                    url: 'get_vegetables_data.php',
                    method: 'POST',
                    data: { action: 'fetch_crop_varieties', Category: Category , origin: origin },
                    success: function(data) {
                        
                        // getting out put displya this id element
                        $('#update_product_variety').html(data);
                    }
                });
            });


            // Fetch Minimum and Mximum price based on selected crop name
            $('#update_product_variety').change(function() {
                
                var origin = $('#update_product_category').val();
                var category = $('#update_product_name').val();
                var name = $(this).val();
                $.ajax({
                    url: 'get_vegetables_data.php',
                    method: 'POST',
                    data: { action: 'fetch_crop_minimum and maxmum price',
                            origin: origin , 
                            category: category , 
                            name: name },
                    success: function(data) {
                        
                        // Set values in the input fields
                        $('#update_minimum_price').val(data.min_price);
                        $('#update_maximum_price').val(data.max_price);
                        
                        // Set min and max attributes for the Product_price input field
                        $('#update_product_price').attr('min', data.min_price);
                        $('#update_product_price').attr('max', data.max_price);
                        
                    },error: function(xhr, status, error) {
                            console.error("Error fetching data:", error);
                    }
                });
            });

        });
            
    </script>


    <!-- output message -->
    <script>
        // show success or error message
        var message ="<?php echo isset($_SESSION['vegetable_manage']) ? $_SESSION['vegetable_manage'] : ''; ?>";   //send vegetable_manage include massage  varible message, but if not vegetable_manage then print ''.

        if (message != "") {
            if(message.includes('successfully')) {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                iconColor: "#69f44a",
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                });
                Toast.fire({
                icon: "success",
                title: message,
                });
            } else {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                iconColor: "#f84444",
                background: "#fae1e1",
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                });
                Toast.fire({
                icon: "error",
                title: message,
                });
            }
            // remove after once message is shown
            <?php unset($_SESSION['vegetable_manage']); ?>
        }   
    </script>


    
</body>
</html>