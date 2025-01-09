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
    <title>Staff Info</title>
</head>
<body class="bg-[#1c4094] text-white">

    <div class="w-screen h-screen">
        
        <div class="flex w-full h-full">

            <!-- Dashboard Menu bar load here-->
            <div class="load_data_container w-[20%]"></div>

            <div class="flex flex-col w-[79%] h-fit">
                
                <!-- Staff Registration Info -->
                <fieldset class="mt-10 ml-4 rounded-2xl p-5 border-2 h-fit border-white w-[75%]">
                    <legend class="font-serif text-xl font-bold">Staff Registration Info</legend>
                    <form action="insert.php" method="post" class="grid justify-between grid-cols-2 gap-5">

                        <div class="flex flex-col w-[300px]">
                            <label for="" class="font-serif text-lg">Name</label>
                            <input type="text" name="name" id="name" class="h-8 p-1 text-black rounded-lg border-1 border-slate-300"required>
                        </div>

                        <div class="flex flex-col w-[300px]">
                            <label for="" class="font-serif text-lg">Email</label>
                            <input type="email" name="email" id="email" class="h-8 p-1 text-black rounded-lg border-1 border-slate-300"required>
                        </div>

                        <div class="flex flex-col w-[300px]">
                            <label for="" class="font-serif text-lg">Username</label>
                            <input type="text" name="username" pattern="[0-9]*" id="username" class="h-8 p-1 text-black rounded-lg border-1 border-slate-300"required>
                        </div>

                        <div class="flex flex-col w-[300px]">
                            <label for="" class="font-serif text-lg">Password</label>
                            <select name="password" id="password" class="h-8 p-1 text-black rounded-lg border-1 border-slate-300"required>
                                <option value="00000">000000</option>
                            </select>
                        </div>

                        <div class="flex flex-col w-[300px]">
                            <label for="" class="font-serif text-lg">Role</label>
                            <select name="role" id="role" class="h-8 p-1 text-black rounded-lg border-1 border-slate-300"required>
                                <option value="assistant">Assistant</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="flex justify-center gap-5 mt-8 ml-4 border-red-300 border-1">
                            <button type="reset" name="clear" id="clear" class="h-8 p-1 rounded-lg bg-slate-500 hover:bg-slate-700 w-28">Clear</button>
                            <button type="submit" name="registar_staff" id="registar_staff" class="h-8 p-1 bg-blue-500 rounded-lg hover:bg-blue-700 w-28">Submit</button>
                        </div>
                        
                    </form>
                </fieldset>

                <!-- Set Up Froget Password -->
                <fieldset class="mt-8 ml-4 p-4 rounded-2xl border-2 h-fit border-white w-[50%]">
                    <legend class="font-serif text-xl font-bold">Set Up Froget Password</legend>
                    <form action="update.php" method="post" class="flex gap-3">
                        <div class="flex flex-col w-[300px]">
                            <label for="" class="font-serif text-lg">Enter staff username</label>
                            <input type="text" pattern="[0-9]*" placeholder="45" name="username" id="username" class="h-8 p-1 text-black rounded-lg border-1 border-slate-300" required>
                        </div>
                        <button type="submit" name="froget_password_update" id="froget_password_update" class="h-8 text-center bg-blue-500 rounded-lg mt-7 border-1 border-slate-300 hover:bg-blue-700 w-28">Update</button>
                    </form>
                </fieldset>

                <!-- staff manage table section -->
                <div class="flex flex-col w-full">
                    <div class="mt-[10px] ml-4">

                        <div class="flex flex-col">

                            <div class="gap-1">
                                <div class="flex">
                                    <h1 class="mt-5 font-serif text-xl">Staff Details</h1>
                                </div>  
                                <form action="" method="post" class="flex mt-1">
                                    <div class="flex gap-2">
                                        <input type="text" class="h-8 p-1 font-sans text-black rounded-md border-1 w-96" name="search_staff" value="<?php if(isset($_POST['search_staff'])){ echo $_POST['search_staff']; } ?>" placeholder="use for search username">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-center h-8 w-[100px] rounded-lg">Search</button>
                                    </div>  
                                </form>                                           
                            </div>
                
                            <div class="mt-3">
                                <div class="card-body table-responsive" id="staff_table" style="max-height: 250px; overflow-y: auto;">
                                    <table class="justify-between w-full font-sans text-center text-white table-auto table-hover">
                                        <thead>
                                            <tr class="h-10 text-center text-black bg-white">
                                                <th>User Name</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Response</th>
                                                <th>Last update</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            <tr>   
                                        </thead>
                                        <tbody id="staffTableBody">
                                            <?php
                                                require('db_conn.php');                      

                                                // search payment detials show here
                                                if(isset($_POST['search_staff'])) {
                                                    $filterstaff = $_POST['search_staff'];

                                                    $query = "SELECT * FROM `staff` WHERE CONCAT(`staff_name`, `staff_userName`) LIKE ?";

                                                    // prepare statment
                                                    $stmt = $conn->prepare($query);

                                                    if ($stmt === false) {
                                                        die('Prepare error: ' . $conn->error);
                                                    }

                                                    $filterstaff = "%$filterstaff%";
                                                    $stmt->bind_param("s", $filterstaff);

                                                    if (!$stmt->execute()) {
                                                        die('Execute error: ' . $stmt->error);
                                                    }

                                                    // Get result set from the statement
                                                    $result = $stmt->get_result();

                                                    if($result && $result->num_rows > 0) {
                                                        
                                                        while($row = $result->fetch_assoc()) {
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td id="staff_username"><?= $row['staff_userName']; ?></td>
                                                                    <td id="staff_name"><?= $row['staff_name']; ?></td>
                                                                    <td><?= $row['staff_email']; ?></td>
                                                                    <td id="staff_type"><?= $row['staff_type']; ?></td>
                                                                    <td><?= $row['reponse']; ?></td>
                                                                    <td><?= $row['update_date']; ?></td>
                                                                    <?php
                                                                        $type = $row['staff_id'];
                                                                        if($row['staff_userName'] == $_SESSION['login_staff_id'][$type]) {
                                                                            ?>
                                                                            <td class="flex items-center justify-center gap-1 mt-1">
                                                                                <i class="text-green-500 fa-solid fa-circle-check"></i>
                                                                                <label class="text-green-500">Active</label>
                                                                            </td>
                                                                            <?php
                                                                        }else{
                                                                            if($row['staff_userName'] == $_SESSION['login_admin_id'][$type]) {
                                                                                ?>
                                                                                <td class="flex items-center justify-center gap-1 mt-1">
                                                                                    <i class="text-green-500 fa-solid fa-circle-check"></i>
                                                                                    <label class="text-green-500">Active</label>
                                                                                </td>
                                                                                <?php
                                                                            }else{
                                                                                ?>
                                                                                <td class="flex items-center justify-center gap-1 mt-1">
                                                                                    <i class="text-red-500 fa-solid fa-circle-exclamation"></i>
                                                                                    <label class="text-red-500">Inactive</label>
                                                                                </td>
                                                                            <?php
                                                                            }
                                                                            
                                                                        }
                                                                    ?>
                                                                    <td class="items-center justify-center gap-3 mt-1">
                                                                        <button type="button" id="reply_btn" value="<?= $row['staff_id']; ?>" class="openModalBtn h-fit">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class= "size-6 hover:text-blue-500">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                            </svg>
                                                                        </button>
                                                                        <button type="button" value="<?= $row['staff_id']; ?>" class="inqury_delete_btn h-fit" >
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

                                                    $query = "SELECT * FROM `staff`";

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
                                                                    <td id="staff_username"><?= $row['staff_userName']; ?></td>
                                                                    <td id="staff_name"><?= $row['staff_name']; ?></td>
                                                                    <td><?= $row['staff_email']; ?></td>
                                                                    <td id="staff_type"><?= $row['staff_type']; ?></td>
                                                                    <td><?= $row['reponse']; ?></td>
                                                                    <td><?= $row['update_date']; ?></td>
                                                                    <?php
                                                                        $type = $row['staff_id'];
                                                                        if($row['staff_userName'] == $_SESSION['login_staff_id'][$type]) {
                                                                            ?>
                                                                            <td class="flex items-center justify-center gap-1 mt-1">
                                                                                <i class="text-green-500 fa-solid fa-circle-check"></i>
                                                                                <label class="text-green-500">Active</label>
                                                                            </td>
                                                                            <?php
                                                                        }else{
                                                                            if($row['staff_userName'] == $_SESSION['login_admin_id'][$type]) {
                                                                                ?>
                                                                                <td class="flex items-center justify-center gap-1 mt-1">
                                                                                    <i class="text-green-500 fa-solid fa-circle-check"></i>
                                                                                    <label class="text-green-500">Active</label>
                                                                                </td>
                                                                                <?php
                                                                            }else{
                                                                                ?>
                                                                                <td class="flex items-center justify-center gap-1 mt-1">
                                                                                    <i class="text-red-500 fa-solid fa-circle-exclamation"></i>
                                                                                    <label class="text-red-500">Inactive</label>
                                                                                </td>
                                                                            <?php
                                                                            }
                                                                            
                                                                        }
                                                                    ?>
                                                                    <td class="items-center justify-center gap-3 mt-1">
                                                                        <button type="button" id="openModalBtn" value="<?= $row['staff_id']; ?>" class="openModalBtn h-fit">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class= "size-6 hover:text-blue-500">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                            </svg>
                                                                        </button>
                                                                        <button type="button" value="<?= $row['staff_id']; ?>" class="staff_delete_btn h-fit" >
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

    <!--  create Modal staff update information using tailwind css-->
    <div id="staff_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[420px]">

            <!-- Modal Header -->
            <div class="flex justify-between mb-5">
                <b><h5 class="modal-title" id="exampleModalLabel">Update Staff Information</h5></b>
            </div>

            <!-- Modal Body -->
            <form action="update.php" method="POST">
                <div class="">
                    <div class="flex flex-col gap-2"> 

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="username">Username:</label>
                            <input type="text" name="update_staff_username" id="update_staff_username"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required readonly>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="name">Name:</label>
                            <input type="text" id="update_staff_name" name="update_staff_name"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>

                        <div class="flex flex-col gap-1 font-bold">
                            <label for="role">Role:</label>
                            <select name="update_staff_role" id="update_staff_role" class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                                <option value="admin">Admin</option>
                                <option value="assistant">Assistant</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-4 text-center">
                    <button type="button" id="close" class="w-24 transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                    <button type="submit" name="staff_detail_update" id="staff_detail_update"  class="w-24 transition bg-blue-500 rounded-lg h-9 hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/custom.js"></script>

    <!-- staff information update modal display and hide js code -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all elements with class "openModalBtn"
            const buttons = document.querySelectorAll(".openModalBtn");
            const modal = document.getElementById("staff_modal"); // The modal element
            const close_btn = document.getElementById("close"); // Close button (span or button in modal)

            // Iterate through each button and add a click event listener
            buttons.forEach(button => {
                button.addEventListener("click", function() {
 
                    // Find the closest row to the clicked button
                    let row = this.closest('tr');

                    // Get the username, email, and subject from the row
                    let staff_username = row.querySelector('#staff_username').innerText;
                    let staff_name = row.querySelector('#staff_name').innerText;
                    let staff_role = row.querySelector('#staff_type').innerText;

                    // Set the values in the modal's input fields
                    document.getElementById('update_staff_username').value = staff_username;
                    document.getElementById('update_staff_name').value = staff_name;
                    document.getElementById('update_staff_role').value = staff_role;

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

    <!-- load side menu bar  -->
    <script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/adminpanel.php');
    })
    </script>

    <!-- output message display -->
    <script>
        var message ="<?php echo isset($_SESSION['staff_reg_msg']) ? $_SESSION['staff_reg_msg'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.

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
            <?php unset($_SESSION['staff_reg_msg']); ?>
        } 
    </script>

</body>
</html>