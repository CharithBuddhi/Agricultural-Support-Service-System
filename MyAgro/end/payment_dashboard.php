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
    
    <?php require('user_header.php'); ?>

    <div class="w-screen h-screen">

        <div class="flex flex-col">

            <div class="w-full mt-8 ">

                <h1 class="h-8 mb-2 ml-6 font-serif text-3xl font-bold w-fit">Paid Transactions</h1>
                <!-- pending payment table -->
                <div class="flex flex-col mt-10 ">
                    
                    <h1 class="ml-10 text-2xl font-medium">Pending Payments</h1>
                    <!-- <hr class="ml-10  mt-1 mb-3 border border-slate-300 w-[70%]"> -->

                    <div class="mt-2 ml-10 mr-10" id="staff_table" style="max-height: 250px; overflow-y: auto;">
                        <table class="justify-between w-full font-sans text-center text-white table-auto table-hover">
                            <thead>
                                <tr class="h-10 text-center bg-slate-800 ">
                                    <th>Reg ID</th>
                                    <th>RP ID</th>
                                    <th>Provider Name</th>
                                    <th>Payment Type</th>
                                    <th>Amount Due</th>
                                    <th>Total Amount</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                <tr>   
                            </thead>
                            <tbody id="">
                                <?php
                                    require('db_connect.php');                      
                                    $reg_id = $_SESSION['login_id'];
                                    $cus_type = $_SESSION['login_type'];

                                    $query = "SELECT * FROM `transaction` WHERE (`payment_status` = 'Pending' OR `payment_status` = 'Process' OR `payment_status` = 'Rejected') AND `customer_id` = ? AND `customer_type` = ?";

                                    $stmt = $conn->prepare($query);
                                    
                                    // prepare statment
                                    if ($stmt === false) {
                                        die('Prepare error: ' . $conn->error);
                                    }
                                    
                                    $stmt->bind_param("is", $reg_id, $cus_type);
                                    $stmt->execute();

                                    // Get result set from the statement
                                    $result = $stmt->get_result();

                                    if($result && $result->num_rows > 0) {
                                        
                                        while($row = $result->fetch_assoc()) {
                                            
                                            ?>
                                                <tr class="h-10 text-center text-black border-b-2 border-slate-300">
                                                    <td id="reg_id" ><?= $row['customer_id']; ?></td>
                                                    <td id="item_id" hidden><?= $row['item_id']; ?></td>
                                                    <td id="item_name" hidden><?= $row['item_name']; ?></td>
                                                    <td id="RP_ID"><?= $row['Reference_id']; ?></td>
                                                    <td id="provider_name"><?= $row['provider_name']; ?></td>
                                                    <td >CDM</td>
                                                    <td ><label>Rs. </label><label id="amount_due"><?= $row['total_amount']; ?></label></td>
                                                    <td ><label>Rs. </label><label id="total_amount"><?= $row['total_amount']; ?></label></td>
                                                    <td id="customer_name" hidden><?= $row['customer_name']; ?></td>
                                                    <td id="created"><?= $row['created']; ?></td>
                                                    <?php 
                                                        $status = $row['payment_status'];
                                                        if($status == 'Pending') {
                                                            ?>
                                                            <td class="items-center justify-center p-1 text-white"><label class="pl-1 pr-1 pb-0.5 bg-yellow-400 rounded-md">Pending</label></td>
                                                            <td class="flex justify-center">
                                                                <button type="button" id="openModalBtn" value="<?= $row['Reference_id']; ?>" class="flex mt-1 openModalBtn hover:text-blue-500">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                                                                    </svg>
                                                                    <label class="mt-0.5">Upload</label>
                                                                </button>
                                                            </td>
                                                            <?php
                                                        }else if($status == 'Process'){
                                                            ?>
                                                            <td class="items-center justify-center p-1 text-white"><label class="pl-2 pr-2 pb-0.5 bg-yellow-500 rounded-md">Process</label></td>
                                                            <td class="items-center justify-center"><label class="">Uploaded</label></td>
                                                            <?php
                                                        }else if($status == 'Rejected'){
                                                            ?>
                                                            <td class="items-center justify-center p-1 text-white"><label class="pl-1 pr-1 pb-0.5 bg-orange-500 rounded-md">Rejected</label></td>
                                                            <td class="flex justify-center">
                                                                <button type="button" id="openModalBtn" value="<?= $row['Reference_id']; ?>" class="flex mt-1 openModalBtn hover:text-blue-500">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                                                                    </svg>
                                                                    <label class="mt-0.5">Upload</label>
                                                                </button>
                                                            </td>
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

                <!-- complete payment table -->
                <div class="flex flex-col mt-10 ">
                    
                    <h1 class="ml-10 text-2xl font-medium">Complete Payments</h1>

                    <div class="mt-2 ml-10 mr-10" id="staff_table" style="max-height: 250px; overflow-y: auto;">
                        <table class="justify-between w-full font-sans text-center text-white table-auto table-hover">
                            <thead>
                                <tr class="h-10 text-center bg-slate-800 ">
                                    <th>RP ID</th>
                                    <th>Provider Name</th>
                                    <th>Payment Type</th>
                                    <th>Paid Amount</th>
                                    <th>Total Amount</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                <tr>   
                            </thead>
                            <tbody id="">
                                <?php
                                    require('db_connect.php');                      
                                    $customer_id = $_SESSION['login_id'];
                                    $cus_type = $_SESSION['login_type'];

                                    $query = "SELECT * FROM `transaction` WHERE `payment_status` = 'succeeded' AND `customer_id` = '$customer_id' AND `customer_type` = '$cus_type'";

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
                                                    <td id="RP_ID"><?= $row['Reference_id']; ?></td>
                                                    <td ><?= $row['provider_name']; ?></td>
                                                    <td >
                                                        <?php
                                                            if(isset($row['stripe_id'])){
                                                                echo "Online";
                                                            }else{
                                                                echo "CDM";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td ><?= "Rs. ".$row['paid_amount']; ?></td>
                                                    <td ><?= "Rs. ".$row['total_amount']; ?></td>
                                                    <td ><?= $row['created']; ?></td>
                                                    <td class="items-center justify-center p-1 text-white"><label class="pl-1 pr-1 pb-0.5 bg-green-500 rounded-md">Complete</label></td>
                                                </tr>

                                            <?php
                                        }
                                        $stmt->close();

                                    }else{
                                        ?>
                                        <tr>
                                            <td class="h-10 text-center text-black border-b-2 border-slate-300" colspan="9">You have no completed record</td>
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
                                    <th>RP ID</th>
                                    <th>Provider Name</th>
                                    <th>Payment Type</th>
                                    <th>Product Name</th>
                                    <th>Total Amount</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                <tr>   
                            </thead>
                            <tbody id="">
                                <?php
                                    require('db_connect.php');                      
                                    $customer_id = $_SESSION['login_id'];
                                    $cus_type = $_SESSION['login_type'];

                                    $query = "SELECT * FROM `transaction` WHERE `payment_status` = 'Canceled' AND `customer_id` = '$customer_id' AND `customer_type` = '$cus_type'";

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
                                                    <td id="RP_ID"><?= $row['Reference_id']; ?></td>
                                                    <td ><?= $row['provider_name']; ?></td>
                                                    <td >
                                                        <?php
                                                            if(isset($row['stripe_id'])){
                                                                echo "Online";
                                                            }else{
                                                                echo "CDM";
                                                            }
                                                         ?>
                                                    </td>
                                                    <td ><?= $row['item_name']; ?></td>
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

    <!--  CDM Slip upload slip-->
    <div id="CDM_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[420px]">

            <!-- Modal Header -->
            <div class="flex justify-between mb-5">
                <b><h5 class="modal-title" id="exampleModalLabel">CDM payment slip upload</h5></b>
            </div>

            <!-- Modal Body -->
            <form action="updatefont.php" method="POST" enctype="multipart/form-data">
                <div class="">
                    <div class="flex flex-col gap-2"> 

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="username">Reg ID:</label>
                            <input type="text" name="voucher_Reg_ID" id="voucher_Reg_ID"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="username">RP ID:</label>
                            <input type="text" name="voucher_RP_ID" id="voucher_RP_ID"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="name">Product Name:</label>
                            <input type="text" id="voucher_product_name" name="voucher_product_name"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required readonly>
                            <input type="text" id="voucher_product_id" name="voucher_product_id"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required hidden>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="name">Amount Due:</label>
                            <input type="text" max="" id="voucher_amount_due" name="voucher_amount_due"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="name">Total Amount:</label>
                            <input type="text" id="voucher_total_amount" name="voucher_total_amount"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="name">Provider Name:</label>
                            <input type="text" id="voucher_provider_name" name="voucher_provider_name"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="name">customer Name:</label>
                            <input type="text" id="voucher_customer_name" name="voucher_customer_name"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="name">Upload Voucher:</label>
                            <input type="file" accept="image/*" id="voucher_image" name="voucher_image"  class="h-12 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>

                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-4 text-center">
                    <button type="button" id="close" class="w-24 transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                    <button type="submit" name="payment_detail_update" id="payment_detail_update"  class="w-24 transition bg-blue-500 rounded-lg h-9 hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- sweetalert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CDM Slip upload modal display and hide js code -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all elements with class "openModalBtn"
            const buttons = document.querySelectorAll(".openModalBtn");
            const modal = document.getElementById("CDM_modal"); // The modal element
            const close_btn = document.getElementById("close"); // Close button (span or button in modal)

            // Iterate through each button and add a click event listener
            buttons.forEach(button => {
                button.addEventListener("click", function() {
 
                    // Find the closest row to the clicked button
                    let row = this.closest('tr');

                    // Get the username, email, and subject from the row
                    let Reg_ID = row.querySelector('#reg_id').innerText;
                    let RP_ID = row.querySelector('#RP_ID').innerText;
                    let item_id = row.querySelector('#item_id').innerText;
                    let item_name = row.querySelector('#item_name').innerText;

                    let provider_name = row.querySelector('#provider_name').innerText;
                    let amount_due = row.querySelector('#amount_due').innerText;
                    let total_amount = row.querySelector('#total_amount').innerText;
                    
                    let customer_name = row.querySelector('#customer_name').innerText;

                    // // Set the values in the modal's input fields
                    document.getElementById('voucher_Reg_ID').value = Reg_ID;
                    document.getElementById('voucher_RP_ID').value = RP_ID;
                    document.getElementById('voucher_product_name').value = item_name;
                    document.getElementById('voucher_product_id').value = item_id;
                    document.getElementById('voucher_amount_due').max = amount_due;
                    document.getElementById('voucher_amount_due').value = amount_due;
                    document.getElementById('voucher_total_amount').value = total_amount;
                    document.getElementById('voucher_provider_name').value = provider_name;
                    document.getElementById('voucher_customer_name').value = customer_name;


                    // Open the modal when a button is clicked
                    modal.style.display = "block";

                });
            });

            // When the user clicks on the close button (span), close the modal
            close_btn.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>

    
    <!-- show output message -->
    <script>
        var message ="<?php echo isset($_SESSION['payment_slip']) ? $_SESSION['payment_slip'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.
        if (message != "") {
            if(message.includes('success')) {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                iconColor: "#69f44a",
                timer: 4000,
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
                background: "#fcf2f2",
                timer: 4000,
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
            <?php unset($_SESSION['payment_slip']); ?>
        } 
    </script>

</body>
</html>