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
    </style>
</head>
<body class="bg-[#1c4094] text-white">
    
    <div class="w-screen h-screen">
        <div class="flex w-full h-full">

            <!-- Dashboard Menu bar load here-->
            <div class="load_data_container w-[20%]"></div>

            <div class="flex flex-col w-[79%] h-fit">
                
                <!-- farmer manage table section -->
                <div class="flex flex-col w-full">
                    <div class="mt-[10px] ml-4">

                        <div class="flex flex-col">

                            <div class="gap-1">
                                <div class="flex">
                                    <h1 class="mt-5 font-serif text-2xl">Farmer Details</h1>
                                </div>  
                                <form action="" method="post" class="flex mt-1">
                                    <div class="flex gap-2">
                                        <input type="text" class="h-8 p-1 font-sans text-black rounded-md border-1 w-96" name="search_farmer" value="<?php if(isset($_POST['search_farmer'])){ echo $_POST['search_farmer']; } ?>" placeholder="Use for search username" required>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-center h-8 w-[100px] rounded-lg">Search</button>
                                    </div>  
                                </form>                                           
                            </div>
                
                            <div class="mt-3">
                                <div class="" id="customer_table" style="max-height: 310px; overflow-y: auto;">
                                    <table class="w-full font-sans text-center text-white table-auto table-hover">
                                        <thead>
                                            <tr class="h-10 text-center text-black bg-white">
                                                <th>User Name</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>NIC</th>
                                                <th>Proof</th>
                                                <th>Response</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            <tr>   
                                        </thead>
                                        <tbody id="farmerTableBody">
                                            <?php
                                                require('db_conn.php');                      

                                                // search payment detials show here
                                                if(isset($_POST['search_farmer'])) {
                                                    $filterfarmer = $_POST['search_farmer'];

                                                    $query = "SELECT * FROM `farmer` WHERE CONCAT(`username`, `farmer_name`) LIKE ?";

                                                    // prepare statment
                                                    $stmt = $conn->prepare($query);

                                                    if ($stmt === false) {
                                                        die('Prepare error: ' . $conn->error);
                                                    }

                                                    $filterfarmer = "%$filterfarmer%";
                                                    $stmt->bind_param("s", $filterfarmer);

                                                    if (!$stmt->execute()) {
                                                        die('Execute error: ' . $stmt->error);
                                                    }

                                                    // Get result set from the statement
                                                    $result = $stmt->get_result();

                                                    if($result && $result->num_rows > 0) {
                                                        
                                                        while($row = $result->fetch_assoc()) {
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td id="farmer_id" class="hidden"><?= $row['farmer_id']; ?></td>
                                                                    <td id="farmer_address" class="hidden"><?= $row['farmer_address']; ?></td>
                                                                    <td id="farmer_phone" class="hidden"><?= $row['farmer_phone']; ?></td>
                                                                    <td id="farmer_username"><?= $row['username']; ?></td>
                                                                    <td id="farmer_name"><?= $row['farmer_name']; ?></td>
                                                                    <td id="farmer_email"><?= $row['farmer_email']; ?></td>
                                                                    <td id="farmer_nic"><?= $row['farmer_nic']; ?></td>
                                                                    <td ><?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/admin/images/user/'.$row['farmer_proof'].'" width="50px" height="50px" class="ml-2 farmer_proof_doc">'; ?></td>
                                                                    <td ><?= $row['response']; ?></td>
                                                                    <?php
                                                                        if($row['farmer_status'] == 0) {
                                                                            ?>
                                                                            <td class="gap-1 w-[80px] shrink-0 mt-1 items-center justify-center">
                                                                                <i class="text-green-500 fa-solid fa-circle-check"></i>
                                                                                <label class="text-green-500">Active</label>
                                                                            </td>
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <td class="gap-1 mt-1 w-[80px] shrink-0 items-center justify-center">
                                                                                <i class="text-yellow-400 fa-solid fa-circle-exclamation"></i>
                                                                                <label class="text-yellow-500">Hold</label>
                                                                            </td>
                                                                            <?php
                                                                            
                                                                        }
                                                                    ?>
                                                                    <td class="items-center justify-center mt-1">
                                                                        <button type="button" value="<?= $row['farmer_id']; ?>" class="farmer_status_hold_btn h-fit">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-yellow-600">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                                            </svg>
                                                                        </button>
                                                                        <button type="button" value="<?= $row['farmer_id']; ?>" class="farmer_status_active_btn h-fit" >
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-green-600">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                            </svg>
                                                                        </button>
                                                                        <button type="button" id="update_btn" value="<?= $row['farmer_id']; ?>" class="openfarmer_modal h-fit">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class= "size-6 hover:text-blue-500">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                            </svg>
                                                                        </button>
                                                                        <button type="button" value="<?= $row['farmer_id']; ?>" class="farmer_detail_delete_btn h-fit" >
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-red-500">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                            </svg>
                                                                        </button>
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

                                                    $query = "SELECT * FROM `farmer`";

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

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td id="farmer_id" class="hidden"><?= $row['farmer_id']; ?></td>
                                                                    <td id="farmer_address" class="hidden"><?= $row['farmer_address']; ?></td>
                                                                    <td id="farmer_phone" class="hidden"><?= $row['farmer_phone']; ?></td>
                                                                    <td id="farmer_username"><?= $row['username']; ?></td>
                                                                    <td id="farmer_name"><?= $row['farmer_name']; ?></td>
                                                                    <td id="farmer_email"><?= $row['farmer_email']; ?></td>
                                                                    <td id="farmer_nic"><?= $row['farmer_nic']; ?></td>
                                                                    <td ><?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/admin/images/user/'.$row['farmer_proof'].'" width="50px" height="50px" class="ml-2 farmer_proof_doc">'; ?></td>
                                                                    <td ><?= $row['response']; ?></td>
                                                                    <?php
                                                                        if($row['farmer_status'] == 0) {
                                                                            ?>
                                                                            <td class="gap-1 w-[80px] shrink-0 mt-1 items-center justify-center">
                                                                                <i class="text-green-500 fa-solid fa-circle-check"></i>
                                                                                <label class="text-green-500">Active</label>
                                                                            </td>
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <td class="gap-1 mt-1 w-[80px] shrink-0 items-center justify-center">
                                                                                <i class="text-yellow-400 fa-solid fa-circle-exclamation"></i>
                                                                                <label class="text-yellow-500">Hold</label>
                                                                            </td>
                                                                            <?php
                                                                            
                                                                        }
                                                                    ?>
                                                                    <td class="items-center justify-center mt-1">
                                                                        <button type="button" value="<?= $row['farmer_id']; ?>" class="farmer_status_hold_btn h-fit">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-yellow-600">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                                            </svg>
                                                                        </button>
                                                                        <button type="button" value="<?= $row['farmer_id']; ?>" class="farmer_status_active_btn h-fit" >
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-green-600">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                            </svg>
                                                                        </button>
                                                                        <button type="button" id="update_btn" value="<?= $row['farmer_id']; ?>" class="openfarmer_modal h-fit">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class= "size-6 hover:text-blue-500">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                            </svg>
                                                                        </button>
                                                                        <button type="button" value="<?= $row['farmer_id']; ?>" class="farmer_detail_delete_btn h-fit" >
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-red-500">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                            </svg>
                                                                        </button>
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

    <!-- Modal for farmer proof document view -->
    <div id="farmer_proof_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">      
        <div class="p-4 rounded-xl border shadow-2xl border-slate-500 bg-[#fefefe] text-black"
            style="max-width: 90%; max-height: 90%; overflow-y: auto;">

            <!-- Modal Header -->
            <div class="mb-5">
                <b><h5>Farmer Verification Document</h5></b>
            </div>

            <!-- Modal Body -->
            <div class="flex items-center justify-center align-middle">
                <img src="" alt="user proof document" class="object-contain modal-img">
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-2 mt-4 text-center">
                <button type="button" id="close" class="w-24 transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
            </div>
        </div>
    </div>

    <!--  Modal for farmer update information view-->
    <div id="farmer_update_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[420px]">

            <!-- Modal Header -->
            <div class="flex justify-between mb-5">
                <b><h5 class="modal-title" id="exampleModalLabel">Update Farmer Information</h5></b>
            </div>

            <!-- Modal Body -->
            <form action="update.php" method="POST" enctype="multipart/form-data">
                <div class="">
                    <div class="flex flex-col gap-2"> 
                        
                        <input type="text" name="update_farmer_id" id="update_farmer_id" hidden>
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="update_farmer_name">Farmer Name:</label>
                            <input type="text" name="update_farmer_name" id="update_farmer_name"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>
                        
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="update_farmer_username">Farmer Username:</label>
                            <input type="text" name="update_farmer_username" id="update_farmer_username"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="update_farmer_NIC">Farmer NIC:</label>
                            <input type="text" name="update_farmer_NIC" id="update_farmer_NIC"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>
                        

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="update_farmer_email">Farmer Email:</label>
                            <input type="text" name="update_farmer_email" id="update_farmer_email"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="update_farmer_address">Farmer Address:</label>
                            <input type="text" id="update_farmer_address" name="update_farmer_address"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="update_farmer_phone">Farmer Phone:</label>
                            <input type="text" name="update_farmer_phone" id="update_farmer_phone"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="farmer_proof_doc">Proof document</label>
                            <input type="file" accept="image/*" id="farmer_proof_doc" name="farmer_proof_doc" placeholder="Product name" class="w-72 border-2 h-[30px] border-black rounded-md" >
                        </div>

                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-4 text-center">
                    <button type="button" id="close_farmer_update_btn" class="w-24 transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                    <button type="submit" name="farmer_detail_update" id="farmer_detail_update"  class="w-24 transition bg-blue-500 rounded-lg h-9 hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- delete customer datails for use this script -->
    <script src="js/custom.js"></script>
    <!-- update customre status Hold or Active use this script -->
    <script src="js/update.js"></script>

    <!-- load side menu bar  -->
    <script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/adminpanel.php');
    })
    </script>

    <!-- farmer proof document popup and hide function -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const modal = document.getElementById("farmer_proof_modal"); 
            const farmer_update_modal = document.getElementById("farmer_update_modal"); 
            const close_btn = document.getElementById("close"); 
            const close_farmer_update_btn = document.getElementById("close_farmer_update_btn");

            function centerModal() {
                modal.style.display = "block"; // After modal show set modal attribute again

                modal.style.display = "flex";
                modal.style.alignItems = "center";  // Use camelCase for 'align-items'
                modal.style.justifyContent = "center";  // Use camelCase for 'justify-content'

            }

            document.addEventListener("click", function (e) {
                //if click on the framer proof document then set that doc src for modal
                if (e.target.classList.contains("farmer_proof_doc")) {
                    const src = e.target.getAttribute("src");
                    document.querySelector(".modal-img").src = src;

                    // call function to center modal
                    centerModal();
                }
            });

            // When the user clicks on the close button (span), close the modal
            close_btn.onclick = function() {
                modal.style.display = "none";
            }

            close_farmer_update_btn.onclick = function() {
                farmer_update_modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                if (event.target == farmer_update_modal) {
                    farmer_update_modal.style.display = "none";
                }
            }
        });
    </script>

    <!-- pass value for update modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // Get all reply buttons
            let updateButtons = document.querySelectorAll('#update_btn');
            const farmer_update_modal = document.getElementById("farmer_update_modal");

            // Add a click event listener to each reply button
            updateButtons.forEach(function (button) {
                button.addEventListener('click', function () {

                    // Find the closest row to the clicked button
                    let row = this.closest('tr');

                    // Get the username, email, and subject from the row
                    let farmer_id = row.querySelector('#farmer_id').innerText;
                    let farmer_name = row.querySelector('#farmer_name').innerText;
                    let farmer_address = row.querySelector('#farmer_address').innerText;
                    let farmer_phone = row.querySelector('#farmer_phone').innerText;
                    let farmer_username = row.querySelector('#farmer_username').innerText;
                    let farmer_email = row.querySelector('#farmer_email').innerText;
                    let farmer_nic = row.querySelector('#farmer_nic').innerText;


                    // Set the values in the modal's input fields
                    document.getElementById('update_farmer_id').value = farmer_id;
                    document.getElementById('update_farmer_name').value = farmer_name;
                    document.getElementById('update_farmer_address').value = farmer_address;
                    document.getElementById('update_farmer_phone').value = farmer_phone;
                    document.getElementById('update_farmer_username').value = farmer_username;
                    document.getElementById('update_farmer_email').value = farmer_email;
                    document.getElementById('update_farmer_NIC').value = farmer_nic;

                    farmer_update_modal.style.display = "block";
                });
            });
        });
    </script>

    <!-- response message display -->
    <script>
        var message ="<?php echo isset($_SESSION['farmer_info_msg']) ? $_SESSION['farmer_info_msg'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.
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
            <?php unset($_SESSION['farmer_info_msg']); ?>
        } 
    </script>

</body>
</html> 