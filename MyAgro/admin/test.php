<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Selection</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<button  class="w-40 h-8 bg-blue-300  font-bold">froget password</button>

    <!--  get email from user modal -->
    <div id="email_modal" class="bg-black bg-opacity-50 fixed inset-0 flex items-center justify-center" style="display: none;">
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[420px]">

            <!-- Modal Header -->
            <div class="flex mb-5 items-center justify-center">
                <b><h5 class="modal-title text-2xl font-bold" id="exampleModalLabel">Froget Password</h5></b>
            </div>

            <!-- Modal Body -->
            <form action="sendmail.php" method="POST">

                <div class="flex flex-col gap-2"> 
                    <div class="font-medium">
                        <label>This email account will receive an OTP code. You can reset your account password by entering that code.</label>
                    </div>

                    <div class="flex flex-col gap-1 font-bold">
                        <label for="froget_mail">Enter your email</label>
                        <input type="email" id="froget_mail" name="froget_mail" placeholder="emaple@gmail.com" class="p-1 h-10 border-2 rounded-lg w-96 border-slate-300" required>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="mt-4 gap-2 flex text-center justify-end">
                    <button type="button" id="close" class="close w-24 h-9 text-white rounded-lg bg-slate-400 hover:bg-slate-500 transition">Close</button>
                    <button type="submit" name="froget_password_mail" id="froget_password_mail"  class="w-24 h-9 text-white rounded-lg bg-blue-500 hover:bg-blue-600 transition">Send</button>
                </div>

            </form>

        </div>
    </div>

    <!--  verify otp modal -->
    <div id="otp_modal" class="bg-black bg-opacity-50 fixed inset-0 flex items-center justify-center"  style="display: none;">
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[420px]">

            <!-- Modal Header -->
            <div class="flex mb-5 items-center justify-center">
                <b><h5 class="modal-title text-2xl font-bold" id="exampleModalLabel">OTP Verification</h5></b>
            </div>

            <!-- Modal Body -->
            <form action="update.php" method="POST">

                <div class="flex flex-col gap-2"> 
                    <div class="font-medium">
                        <label>Please enter the OTP number received in your email address</label>
                    </div>

                    <div class="flex flex-col gap-1 font-bold">
                        <label for="otp_number">Enter OTP number</label>
                        <input type="text" id="otp_number" name="otp_number" class="p-1 h-10 border-2 rounded-lg w-96 border-slate-300" required>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="mt-4 gap-2 flex text-center justify-end">
                    <button type="button" id="close" class="close w-24 h-9 text-white rounded-lg bg-slate-400 hover:bg-slate-500 transition">Close</button>
                    <button type="submit" name="otp_verify" id="otp_verify"  class="w-24 h-9 text-white rounded-lg bg-blue-500 hover:bg-blue-600 transition">Check</button>
                </div>

            </form>

        </div>
    </div>

    <!-- change password modal -->
    <div id="password_modal" class="bg-black bg-opacity-50 fixed inset-0 flex items-center justify-center" style="display: none;">
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-fit">

            <!-- Modal Header -->
            <div class="flex mb-5 items-center justify-center">
                <b><h5 class="modal-title text-2xl font-bold" id="exampleModalLabel">Change Password</h5></b>
            </div>

            <!-- Modal Body -->
            <form action="update.php" method="POST">

                <div class="flex flex-col gap-2"> 
                    <div class="font-medium mb-2">
                        <label>Please enter your new password</label>
                    </div>

                    <div class="flex gap-2 font-bold">
                        <div class="flex flex-col gap-1">
                            <label for="new_password" class="ml-1">New Password</label>
                            <input type="text" id="new_password" name="new_password" class="p-1 h-10 border-2 rounded-lg w-60 border-slate-300" required>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="confirm_password" class="ml-1">Confirm Password</label>
                            <input type="text" id="confirm_password" name="confirm_password" class="p-1 h-10 border-2 rounded-lg w-60 border-slate-300" required>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="mt-4 gap-2 flex text-center justify-end">
                    <button type="button" id="close" class="close w-24 h-9 text-white rounded-lg bg-slate-400 hover:bg-slate-500 transition">Close</button>
                    <button type="submit" name="update_password" id="update_password"  class="w-24 h-9 text-white rounded-lg bg-blue-500 hover:bg-blue-600 transition">Update</button>
                </div>

            </form>

        </div>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- staff information update modal display and hide js code -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const buttons = document.getElementById("openModalBtn");
            const email_modal = document.getElementById("email_modal"); 
            const email_close = document.getElementById("email_close");
            const otp_modal = document.getElementById("otp_modal"); 
            const otp_close = document.getElementById("otp_close");
            const password_modal = document.getElementById("password_modal"); 
            const password_close = document.getElementById("password_close");

            buttons.addEventListener("click", function() {
               
                email_modal.style.display = "block";
            });

            email_close.onclick = function() {
                email_modal.style.display = "none";
            }

            otp_close.onclick = function() {
                otp_modal.style.display = "none";
            }

            password_close.onclick = function() {
                password_modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == email_modal) {
                    email_modal.style.display = "none";
                }else if (event.target == otp_modal) {
                    otp_modal.style.display = "none";
                }else if (event.target == password_modal) {
                    password_modal.style.display = "none";
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

    <!-- response message display -->
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
