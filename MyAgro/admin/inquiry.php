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
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }
    </style>
    <title>Inquire</title>

</head>
<body class="bg-[#350dc3] text-white">
    
<div class="flex w-full h-screen">
    <!-- load staff menu bar here -->
    <div class="load_data_container w-[20%]"></div>

    <div class="flex flex-col w-[79%] ">
        <div class="h-[70%] ml-5">
            <!-- heder section of the page -->
             <div class="flex justify-between mt-10 mb-3 ">  <!--border-2 border-red-600 -->
                <h1 class="text-2xl ">User Inquires</h1>   
            </div>  
            
            <!-- inquires display table here -->
            <table class="table mt-1 text-center text-white table-hover hover:text-[#dfdde3]">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Inquire No</th>
                        <th scope="col">User Name</th>
                        <th scope="col">User Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Action</th>
                    <tr>   
                </thead>
                <tbody>    
                    <?php
                        require('db_conn.php');
                        
                        $query = "SELECT * FROM `inquiry` WHERE inquire_status = '1'";
                        $query_run = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($query_run) >  0) {
                            while($row = mysqli_fetch_array($query_run)) {
                                ?>
                                    <tr class="h-fit">
                                        <td class="font-bold" id="userid"><?= $row['notify_id']; ?></td>
                                        <td id="username"><?= $row['notify_name']; ?></td>
                                        <td id="useremail"><?= $row['notify_email']; ?></td>
                                        <td id="usersubject" class="text-black">
                                            <textarea class="rounded-lg disabled:bg-white" disabled cols="25" rows="2"><?= $row['notify_subject']; ?></textarea>
                                        </td>
                                        <td class="text-black">
                                            <textarea class="rounded-lg disabled:bg-white" disabled cols="25" rows="2"><?= $row['notify_msg']; ?></textarea>
                                        </td>
                                        <td class="flex justify-center w-[100px] h-[100px] gap-3">
                                            <button type="button" id="reply_btn" class="h-fit" data-bs-toggle="modal" data-bs-target="#inqury_reply">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class= "size-6 hover:text-blue-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                            <button type="button" value=<?= $row['notify_id'] ?> class="inqury_delete_btn h-fit" >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
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
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<!-- Modal for inqury massage view -->
<div class="modal fade" id="inqury_reply" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content absolute text-black left-[200px] w-[500px]">
            <div class="modal-header">
                <b><h5 class="modal-title" id="exampleModalLabel">Replay Inquiry</h5></b>
                <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="inqury_sendmail.php" method="POST">
                <div class="modal-body">
                    <input type="text" hidden name="id" id="id" required>
                    <div class="flex flex-col gap-2"> 
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="">Name:</label>
                            <input type="text" name="name" id="name"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="">Email:</label>
                            <input type="text" id="email" name="email"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>
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
                    <button type="submit" name="inqury_submit"  class="btn btn-primary">Send Replay</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

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
                let subject = row.querySelector('#usersubject textarea').value;

                // Set the values in the modal's input fields
                document.getElementById('id').value = userid;
                document.getElementById('name').value = username;
                document.getElementById('email').value = email;
                document.getElementById('subject').value = subject;
            });
        });
    });
</script>

<script>

// show inquiry reply success or error message
var message =
  "<?php echo isset($_SESSION['status']) ? $_SESSION['status'] : ''; ?>"; //send status include massage  varible message, but if not status then print ''.

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
    <?php unset($_SESSION['status']); ?>
}   
</script>

</body>
</html>