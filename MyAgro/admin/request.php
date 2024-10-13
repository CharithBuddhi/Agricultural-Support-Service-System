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
    <title>Request</title>
    <!-- talwind css cdn -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/src/style.css">
    <!-- admin include css file style sheet and boostrap stylesheet-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- boostrap cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font-awesome icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }  
    </style>


</head>
<body class="text-white bg-[#350dc3]">

<div class="flex w-full h-full">
    <!-- load staff menu bar here -->
    <div class="load_data_container w-[20%]"></div>
    
    <div class="flex flex-col w-[79%] rounded-3xl pl-2 ml-1">
        <div class="flex gap-5">
            <h1 class="mt-10 text-2xl text-left font-sembiold">New Request</h1>
            <button type="button" onclick="reload()" id="btn_reload" class="bg-blue-300 font-semibold relative top-10 left-[700px] w-[100px] h-[34px] text-center rounded-xl border-2">Available</button>
        </div>

        <!-- table -->
        <form action="" method="post" enctype="multipart/form-data" class="flex flex-col mt-3"> 
            <table class="table text-center text-white table-hover">
                <thead class="table-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">NIC</th>
                    <th scope="col">Shop Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Proof</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody  >

                    <?php 
                        require('db_conn.php');

                        $sql = "SELECT * FROM request WHERE user_action = '0'";
                        $result = mysqli_query($conn, $sql);
                        
                        while($row = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td class="font-bold" id="userid"><?php echo $row['request_id']; ?></td>
                                <td id="username"><?php echo $row['your_name']; ?></td>
                                <td><?php echo $row['nic_number']; ?></td>
                                <td><?php echo $row['shop_name']; ?></td>
                                <td id="useremail"><?php echo $row['user_email']; ?></td>
                                <!-- get image from array -->
                                <td><?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/admin/images/reg/'.$row['proof_image'].'" width="50px" height="50px" class="proof_doc">'; ?></td>
                                <td><?php echo $row['user_type']; ?></td>
                                <td > 
                                    <!-- approve button -->                                      
                                    <a href="approve.php?id=<?php echo $row['request_id']; ?>" class="ml-2 mr-1" type="submit">
                                        <i class="text-green-500 fa-regular hover:text-black fa-circle-check fa-xl"></i>
                                        <!-- <i class=" fa-square-check"></i> -->
                                    </a>
                                    <button type="button" id="reply_btn" class="ml-1 mr-1" value="<?= $row['request_id']; ?>" data-bs-toggle="modal" data-bs-target="#request_reply">
                                        <i class="text-blue-500 fa-solid hover:text-black fa-xl fa-pen-to-square"></i>
                                    </button>                                                         
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</div>



 <!-- Modal for proof document view -->
<div class="modal fade" id="proof-document" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><h5 class="text-black modal-title" id="exampleModalLabel">Verification Document</h5></b>
                <button type="button" class="text-red-600 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="images/1.jpg" alt="user proof document" class="modal-img">
            </div>
            <div class="modal-footer">
                <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Request reply send module -->
<div class="modal fade" id="request_reply" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content absolute text-black left-[200px] w-[500px]">
            <div class="modal-header">
                <b><h5 class="modal-title" id="exampleModalLabel">Replay Request</h5></b>
                <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="inqury_sendmail.php" method="POST">
                <div class="modal-body">
                    <input type="text" hidden name="id" id="id" required>
                    <input type="text" hidden name="name" id="name"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                    <input type="text" hidden id="email" name="email"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                    <div class="flex flex-col gap-2"> 
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="">Subject:</label>
                            <input type="text" id="subject" name="subject"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="">Message:</label>
                            <textarea  id="message" name="message" col="" rows="6" class="border-2 rounded-lg w-96 border-slate-300" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="request_submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- load side menu bar  -->
<script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/satffpanel.php');
    })
</script>

<!-- get value from table row and display inside reply form -->
 <!-- This javascript code can't save message.js file. 
    becuase here has insdie getElementById('name') '' automaticaly change "". 
    so then this code not work correctly. so use code in this file -->
      
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Get all reply buttons
        let replyButtons = document.querySelectorAll('#reply_btn');

        // Add a click event listener to each reply button
        replyButtons.forEach(function (button) {
            button.addEventListener('click', function () {

                // Find the closest row to the clicked button
                let row = this.closest('tr');

                // Get the username, email, and subject from the row
                let userid = row.querySelector('#userid').innerText;
                let username = row.querySelector('#username').innerText;
                let email = row.querySelector('#useremail').innerText;

                // Set the values in the modal's input fields
                document.getElementById('id').value = userid;
                document.getElementById('name').value = username;
                document.getElementById('email').value = email;

            });
        });
    });
</script>

 <!-- reload for new request checking(refresh page) Available button -->
<script>
    let btn_reload =document.getElementById('btn_reload');
    function reload(){
        location.reload();
    }
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- boostrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<!-- link admin folderinsdie js file main javasript file -->
<script src="js/main.js"></script>
<!-- <script src="js/custom.js"></script> -->

<script>

// show inquiry reply success or error message
var message =
  "<?php echo isset($_SESSION['request_status']) ? $_SESSION['request_status'] : ''; ?>"; //send request_status include massage  varible message, but if not status then print ''.

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
        background: "#fae1e1",
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
    <?php unset($_SESSION['request_status']); ?>
}   
</script>

</body>
</html>