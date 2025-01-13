<?php session_start();
if(!isset($_SESSION['login_staff_user'])){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }
    </style>
    <title>Payment Check</title>
</head>
<body class="bg-[#305dc7] text-white">

<div class="flex w-full h-screen">

    <!-- load staff menu bar here -->
    <div class="load_data_container w-[20%]"></div> 

    <div class="flex flex-col w-[79%] ">

        <div class="ml-5">
            <!-- heder section of the page -->
            <div class="flex justify-between mt-10 mb-3 ">
                <h1 class="text-2xl ">Payment Transaction Details</h1>   
            </div>
            <div class="h-[50px]">        
                <div class="col-md-7">

                    <form action="" method="post" class="flex gap-4e">
                        <div class="input-group">
                            <input type="text" name="search_technology" value="<?php if(isset($_POST['search_payment'])){ echo $_POST['search_payment']; } ?>" class="form-control" placeholder="use for search varities name"  required>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>  
                    </form>
                    
                </div>
            </div>  
            

            <table class="table mt-1 text-center text-white table-hover hover:text-[#dfdde3] " style="max-height: 500px; overflow-y: auto;">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Reg ID</th>
                        <th scope="col">RP ID</th>
                        <th scope="col">Product</th>
                        <th scope="col">Provider</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Pay Type</th>
                        <th scope="col">Amount</th> 
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    <tr>   
                </thead>
                <tbody>    
                    <?php
                        require('db_conn.php');                      

                        // search payment detials show here
                        if(isset($_POST['search_payment'])) {
                            $filtervalues = $_POST['search_payment'];
                            $query = "SELECT * FROM `payment` WHERE CONCAT(`user_name`, `trans_amount`, `account_no`) LIKE '%$filtervalues%'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) >  0) {
                                while($row = mysqli_fetch_array($query_run)) {
                                    ?>
                                        <tr class="h-fit">
                                            <td class="font-bold" id="userid"><?= $row['payment_id']; ?></td>
                                            <td id="username"><?= $row['account_no']; ?></td>
                                            <td><?= $row['account_name']; ?></td>
                                            <td><?= $row['user_name']; ?></td>
                                            <td><?= $row['payment_date']; ?></td>
                                            <td><?= $row['trans_amount']; ?></td>
                                            <td class="flex justify-center gap-2">
                                                <button type="button" value=<?= $row['payment_id'] ?> id="approve_payment" class="p-1 text-sm bg-green-400 border-2 rounded-md h-fit border-slate-400 hover:bg-green-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="font-bold size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                    </svg>
                                                </button>
                                                <button type="button" value=<?= $row['payment_id'] ?> id="reject_payment" class="p-1 text-sm bg-red-500 border-2 rounded-md h-fit border-slate-400 hover:bg-red-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="font-bold size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7">No Record Found</td>
                                </tr>
                                <?php
                            }
                        // defualt payment data show here  
                        }else{

                            $query = "SELECT * FROM `transaction` WHERE payment_status = 'Process' OR payment_status = 'Rejected'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) >  0) {
                                while($row = mysqli_fetch_array($query_run)) {
                                    ?>
                                        <tr class="">
                                            <td class="font-bold" id="db_customer_id"><?= $row['customer_id']; ?></td>
                                            <td id ="db_RP_ID" class="font-bold"><?= $row['Reference_id']; ?></td>
                                            <td id="db_item_id" hidden><?= $row['item_id']; ?></td>
                                            <td id="db_item_name"><?= $row['item_name']; ?></td>
                                            <td id="db_provider_name"><?= $row['provider_name']; ?></td>
                                            <td id="db_customer_name"><?= $row['customer_name']; ?></td>
                                            <td id="db_payment_type">CDM Payment</td>
                                            <td id="db_total_amount"><?= $row['total_amount']; ?></td>
                                            <td><?= $row['created']; ?></td>
                                            <td class="flex justify-center gap-2 ">
                                                <button type="button" value=<?= $row['Reference_id'] ?> id="db_approve" class="p-1 text-sm font-bold bg-green-400 border-2 rounded-md db_approve h-fit border-slate-400 hover:bg-green-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                    </svg>
                                                </button>
                                                <button type="button" value=<?= $row['Reference_id'] ?> id="db_reject" class="p-1 text-sm bg-red-500 border-2 rounded-md db_reject h-fit border-slate-400 hover:bg-red-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="9">No Record Found</td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                        
                </tbody>
            </table>

        </div>


        <!-- Verification of Cash Deposit Voucher -->
        <div class="h-[30%] ml-5">
            <div class="flex justify-between mt-10 mb-3 ">
                <h1 class="text-2xl ">Verification of Cash Deposit Voucher</h1>   
            </div>  
            
            <!-- inquires display table here -->
            <table class="table mt-1 text-center text-white table-hover hover:text-[#dfdde3] " style="max-height: 300px; overflow-y: auto;">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Reg ID</th>
                        <th scope="col">RP ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Provider Name</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Amount Due</th>
                        <th scope="col">Total Amount</th>   
                        <th scope="col">Voucher</th>
                        <th scope="col">Action</th>
                    <tr>   
                </thead>
                <tbody> 
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php
                            require('db_conn.php');
                            
                            $query = "SELECT * FROM `voucher` WHERE action = '0'";
                            $query_run = mysqli_query($conn, $query);
                            
                            if(mysqli_num_rows($query_run) >  0) {
                                while($row = mysqli_fetch_array($query_run)) {
                                    ?>
                                        <tr class="h-fit">
                                            <td class="font-bold" id="userid"><?= $row['customer_id']; ?></td>
                                            <td id ="voucher_id" hidden><?= $row['voucher_id']; ?></td>
                                            <td id ="RP_ID" class="font-bold"><?= $row['rp_id']; ?></td>
                                            <td id="item_id" hidden><?= $row['product_id']; ?></td>
                                            <td id="item_name"><?= $row['product_name']; ?></td>
                                            <td id="provider_name"><?= $row['provider_name']; ?></td>
                                            <td id="customer_name"><?= $row['customer_name']; ?></td>
                                            <td id="amount_due"><?= $row['amount_due']; ?></td>
                                            <td id="total_amount"><?= $row['amount_total']; ?></td>
                                            <!-- get image from array -->
                                            <td><?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/admin/images/payment/'.$row['voucher'].'" width="50px" height="50px" class="payment_doc">'; ?></td>
                                            <td class="flex justify-center h-[68px] gap-2">
                                                <button type="button" value=<?= $row['voucher_id'] ?> id="approve_payment" class="p-1 text-sm font-bold bg-green-400 border-2 rounded-md approve_payment h-fit border-slate-400 hover:bg-green-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                                    </svg>
                                                </button>
                                                <button type="button" value=<?= $row['voucher_id'] ?> id="reject_payment" class="p-1 text-sm bg-red-500 border-2 rounded-md reject_payment h-fit border-slate-400 hover:bg-red-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            } else {
                        ?>
                            <tr>
                                <td colspan="9">No Record Found</td>
                            </tr>
                        <?php
                            }
                        ?>
                    </form>      
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- Modal for payment document view -->
<div class="modal fade" id="payment-document" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><h5 class="text-black modal-title" id="exampleModalLabel">Payment Verification Document</h5></b>
                <button type="button" class="text-red-600 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="images/1.jpg" alt="user payment document" class="modal-img">
            </div>
            <div class="modal-footer">
                <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Payment Transaction accept -->
<div id="confirm_payment_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
    <div class="p-3 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[420px]">

        <!-- Modal Header -->
        <div class="flex justify-between mb-2">
            <b><h5 class="text-2xl modal-title" id="exampleModalLabel">Accept Payment</h5></b>
        </div>

        <!-- Modal Body -->
        <form action="payemnt_handle.php" method="POST">
            <div class="">
                <div class="flex flex-col gap-2"> 

                    <div class="flex flex-col gap-1 font-bold">
                        <label for="username">Reg ID:</label>
                        <input type="text" name="send_db_customer_id" id="send_db_customer_id"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required readonly>
                    </div>

                    <div class="flex flex-col gap-1 font-bold">
                        <label for="username">RP ID:</label>
                        <input type="text" name="send_RP_ID" id="send_RP_ID"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required readonly>
                    </div>

                    <div class="flex flex-col gap-1 font-bold">
                        <label for="name">Product Name:</label>
                        <input type="text" id="send_product_name" name="send_product_name"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        <input type="text" id="send_product_id" name="send_product_id"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required hidden>
                    </div>

                    <div class="flex flex-col gap-1 font-bold">
                        <label for="name">Paid Amount:</label>
                        <input type="text" max="" id="send_amount_due" name="send_amount_due"  class="h-8 border-2 rounded-lg w-96 border-slate-300" required>
                    </div>

                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-2 mt-4 text-center">
                <button type="button" id="close" class="w-24 transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                <button type="submit" name="payment_accept_update" id="payment_accept_update"  class="w-24 transition bg-blue-500 rounded-lg h-9 hover:bg-blue-600">Update</button>
            </div>
        </form>
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".approve_payment");
    const rejectButtons = document.querySelectorAll(".reject_payment");
    const db_approve  = document.querySelectorAll(".db_approve");
    const db_reject = document.querySelectorAll(".db_reject");
    const confirm_payment_modal = document.getElementById("confirm_payment_modal");
    const close_btn = document.getElementById("close");

    buttons.forEach(button => {
        button.addEventListener("click", function() {
            let row = this.closest('tr');

            let voucher_id = row.querySelector('#voucher_id').innerText;
            let RP_ID = row.querySelector('#RP_ID').innerText;
            let item_id = row.querySelector('#item_id').innerText;

            const data = { voucher_id_send: voucher_id, RP_ID_send: RP_ID, item_id_send: item_id, status_btn: "approve" };

            fetch("payemnt_handle.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json()) // Parse the JSON response
            .then(result => {
                if (result.status === 'success') {
                    // Redirect the user
                    window.location.href = "payment_check.php";
                } else {
                    console.error("Error:", result.message);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });

    rejectButtons.forEach(button => {
        button.addEventListener("click", function() {
            let row = this.closest('tr');

            let voucher_id = row.querySelector('#voucher_id').innerText;
            let RP_ID = row.querySelector('#RP_ID').innerText;
            let item_id = row.querySelector('#item_id').innerText;

            const data = { voucher_id_send: voucher_id, RP_ID_send: RP_ID, item_id_send: item_id, status_btn: "reject" };

            fetch("payemnt_handle.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json()) // Parse the JSON response
            .then(result => {
                if (result.status === 'success') {
                    // Redirect the user
                    window.location.href = "payment_check.php";
                } else {
                    console.error("Error:", result.message);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });

    db_reject.forEach(button => {
        button.addEventListener("click", function() {
            
            let row = this.closest('tr');

            let db_RP_ID = row.querySelector('#db_RP_ID').innerText;
            let db_customer_id = row.querySelector('#db_customer_id').innerText;

            const data = { RP_ID_send: db_RP_ID, customer_id_send: db_customer_id, status_btn: "db_cancel" };

            fetch("payemnt_handle.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json()) // Parse the JSON response
            .then(result => {
                if (result.status === 'success') {
                    // Redirect the user
                    window.location.href = "payment_check.php";
                } else {
                    console.error("Error:", result.message);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });

    db_approve.forEach(button => {
        button.addEventListener("click", function() {
            
            let row = this.closest('tr');

            let db_customer_id = row.querySelector('#db_customer_id').innerText;
            let db_RP_ID = row.querySelector('#db_RP_ID').innerText;
            let db_item_id = row.querySelector('#db_item_id').innerText;
            let db_item_name = row.querySelector('#db_item_name').innerText;

            document.getElementById('send_db_customer_id').value = db_customer_id;
            document.getElementById('send_RP_ID').value = db_RP_ID;
            document.getElementById('send_product_id').value = db_item_id;
            document.getElementById('send_product_name').value = db_item_name;

            confirm_payment_modal.style.display = "block";

        });
    });

    close_btn.onclick = function() {
        confirm_payment_modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == confirm_payment_modal) {
            confirm_payment_modal.style.display = "none";
        }
    }

});

</script>

<!-- load side menu bar  -->
<script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/satffpanel.php');
    })
</script>

<script>
var message ="<?php echo isset($_SESSION['payment_status']) ? $_SESSION['payment_status'] : ''; ?>"; //send payment_status include massage  varible message, but if not status then print ''.

if (message != "") {
    if(message.includes('Successfully')) {
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
    <?php unset($_SESSION['payment_status']); ?>
} 
</script>

</body>
</html>