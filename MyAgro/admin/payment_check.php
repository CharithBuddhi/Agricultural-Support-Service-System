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
<body class="bg-[#350dc3] text-white">

<div class="flex w-full h-full">

    <!-- load staff menu bar here -->
    <div class="load_data_container w-[20%]"></div> 

    <div class="flex flex-col w-[79%] ">

        <div class="ml-5">

            <!-- heder section of the page -->
            <div class="flex justify-between mt-10 mb-3 ">  <!--border-2 border-red-600 -->
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
            
            <!-- inquires display table here -->
            <table class="table mt-1 text-center text-white table-hover hover:text-[#dfdde3] " style="max-height: 500px; overflow-y: auto;">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Trans No</th>
                        <th scope="col">Account Number</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Trans Amount</th>
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
                                                <button type="button" value=<?= $row['payment_id'] ?> id="approve_payment" class="h-fit bg-green-400 border-slate-400 rounded-md p-1 text-sm border-2 hover:bg-green-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 font-bold">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                    </svg>
                                                </button>
                                                <button type="button" value=<?= $row['payment_id'] ?> id="reject_payment" class="h-fit bg-red-500 border-slate-400 rounded-md p-1 border-2 text-sm hover:bg-red-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 font-bold">
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
                        // defualt payment data how here  
                        }else{

                            $query = "SELECT * FROM `payment` WHERE action = '0'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) >  0) {
                                while($row = mysqli_fetch_array($query_run)) {
                                    ?>
                                        <tr class="h-fit">
                                            <td class="font-bold" id="userid"><?= $row['payment_id']; ?></td>
                                            <td><?= $row['account_no']; ?></td>
                                            <td><?= $row['account_name']; ?></td>
                                            <td><?= $row['user_name']; ?></td>
                                            <td><?= $row['payment_date']; ?></td>
                                            <td><?= $row['trans_amount']; ?></td>
                                            <td class="flex justify-center gap-2 ">
                                                <button type="button" value=<?= $row['payment_id'] ?> id="approve_payment" class="h-fit bg-green-400 border-slate-400 font-bold rounded-md p-1 text-sm border-2 hover:bg-green-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                    </svg>
                                                </button>
                                                <button type="button" value=<?= $row['payment_id'] ?> id="reject_payment" class="h-fit bg-red-500 border-slate-400 rounded-md p-1 border-2 text-sm hover:bg-red-600 hover:text-white">
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
                                        <td colspan="7">No Record Found</td>
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
            <div class="flex justify-between mt-10 mb-3 ">  <!--border-2 border-red-600 -->
                <h1 class="text-2xl ">Verification of Cash Deposit Voucher</h1>   
            </div>  
            
            <!-- inquires display table here -->
            <table class="table mt-1 text-center text-white table-hover hover:text-[#dfdde3] " style="max-height: 300px; overflow-y: auto;">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Voucher ID</th>
                        <th scope="col">Account Number</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Image</th>
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
                                            <td class="font-bold"><?= $row['voucher_id']; ?></td>
                                            <td ><?= $row['account_no']; ?></td>
                                            <td><?= $row['account_name']; ?></td>
                                            <td><?= $row['user_name']; ?></td>
                                            <!-- get image from array -->
                                            <td><?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/admin/images/payment/'.$row['voucher'].'" width="50px" height="50px" class="payment_doc">'; ?></td>
                                            <td class="flex justify-center h-[68px] gap-2">
                                                <button type="button" value=<?= $row['voucher_id'] ?> id="approve_payment" class="h-fit bg-green-400 border-slate-400 font-bold rounded-md p-1 text-sm border-2 hover:bg-green-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                                    </svg>
                                                </button>
                                                <button type="button" value=<?= $row['voucher_id'] ?> id="reject_payment" class="h-fit bg-red-500 border-slate-400 rounded-md p-1 border-2 text-sm hover:bg-red-600 hover:text-white">
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
                                <td colspan="6">No Record Found</td>
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


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>

<!-- load side menu bar  -->
<script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/satffpanel.php');
    })
</script>

<script>
var message ="<?php echo isset($_SESSION['payment_status']) ? $_SESSION['payment_status'] : ''; ?>"; //send payment_status include massage  varible message, but if not status then print ''.

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
    <?php unset($_SESSION['payment_status']); ?>
} 
</script>

</body>
</html>