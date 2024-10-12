<?php session_start(); ?>   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style.css"> 
    <title>Login page</title>
</head>
<body>

    <!-- navigation bar -->
    <?php require('header.php'); ?>
    
    <!-- login form -->
    <div class="h-full pt-40 pb-[90px] bg-cover bg-no-repeat bg-[url('images/login.jpg')]">
        <div class="flex flex-col items-center h-[63vh] w-[60%] mx-auto rounded-3xl shadow-2xl bg-[#BAEAD3]/50">
            <h1 class="mb-6 font-serif text-6xl italic font-bold text-[#30f915]">MyAgro</h1>
            <div class="p-3 border-1 rounded-3xl shadow-2xl bg-[#BAEAD3]/60">
                <h1 class="mb-10 text-3xl font-bold">Log in to your MyAgro account</h1>
                <div class="flex flex-col items-center">
                    
                    <form action="connect.php" method="post" class="flex flex-col font-semibold w-[300px]">
                        
                        <label for="usertype">Select your user type</label>
                        <select name="usertype" id="usertype" placeholder="E.g. your farmer select “farmer”" class="rounded-lg h-7 placeholder:italic bg-[#f3f2f2]" required>
                            <option disabled selected >Please choose your user type</option>
                            <option value="farmer" name="usertype" >Farmer</option>
                            <option value="customer" name="usertype">Customer</option>
                            <option value="supplier" name="usertype">Supplier</option>
                        </select>
                        
                        <label for="username" class="mt-4">Enter your Username</label>
                        <input type="text" placeholder=" E.g.charitha" name="username" id="username"class="pl-1 rounded-lg h-7 placeholder:italic" required>
                        
                        <label for="password" class="mt-4">Enter your Password</label>
                        <div class="relative flex items-center">
                            <input type="password" placeholder=" pick up your password" id="password" name="password" class="w-full pl-1 rounded-lg h-7 placeholder:italic" required>
                            <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg">
                        </div>
                        
                        <p class="relative mt-1 left-[172px]">
                            <button type="button" id="openModalBtn">Forgot Password?</button>
                        </p>
                        
                        <button type="submit" name="login" id="login" class="text-center mt-6 focus:cursor-pointer h-10 rounded-full bg-[#E8E025] justify-center">Login</button>
                        
                        <p class="relative mt-3 left-8">Don't have an account? <a href="customer.php">Register</a></p>
                    
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!--  get email from user modal -->
    <div id="email_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[420px] p-5 h-fit">

            <!-- Modal Header -->
            <div class="flex items-center justify-center mb-5">
                <b><h5 class="text-2xl font-bold modal-title" id="exampleModalLabel">Froget Password</h5></b>
            </div>

            <!-- Modal Body -->
            <form action="sendmail.php" method="POST">

                <div class="flex flex-col gap-2"> 
                    
                    <div class="p-2 font-medium">
                        <label>This email account will receive an OTP code. You can reset your account password by entering that code.</label>
                    </div>

                    <div class="flex flex-col gap-1 mt-5 font-bold">
                        <label for="froget_mail">Enter your email</label>
                        <input type="email" id="froget_mail" name="froget_mail" placeholder="emaple@gmail.com" class="h-10 p-1 border-2 rounded-lg w-96 border-slate-300" required>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end gap-2 mt-4 text-center">
                        <button type="button" id="email_close" class="w-24 text-white transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                        <button type="submit" name="froget_password_mail" id="froget_password_mail"  class="w-24 text-white transition bg-blue-500 rounded-lg h-9 hover:bg-blue-600">Send</button>
                    </div>

                </div>


            </form>

        </div>
    </div>

    <!--  verify otp modal -->
    <div id="otp_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"  style="display: none;">
        <div class="p-6 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[420px] h-fit">

            <!-- Modal Header -->
            <div class="flex items-center justify-center mb-5">
                <b><h5 class="text-2xl font-bold modal-title" id="exampleModalLabel">OTP Verification</h5></b>
            </div>

            <!-- Modal Body -->
            <form action="#" method="POST">

                <div class="flex flex-col gap-2 mt-8"> 
                    <div class="p-2 font-medium">
                        <label>Please enter the OTP number received in your email address</label>
                    </div>

                    <div class="flex flex-col gap-1 mt-6 mb-5 font-bold">
                        <label for="otp_number">Enter OTP number</label>
                        <input type="text" id="otp_number" name="otp_number" class="h-10 p-1 border-2 rounded-lg w-96 border-slate-300" required>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-4 text-center">
                    <button type="button" id="otp_close" class="w-24 text-white transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                    <button type="submit" name="otp_verify" id="otp_verify"  class="w-24 text-white transition bg-blue-500 rounded-lg h-9 hover:bg-blue-600">Check</button>
                </div>

            </form>

        </div>
    </div>

    <?php
         
        if(isset($_SESSION['froget_otp_send'])){
            echo '<script>
            document.getElementById("email_modal").style.display = "none";
            document.getElementById("otp_modal").style.display = "block";
            </script>';
        }
    
    ?>

    <!-- change password modal -->
    <div id="password_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="p-6 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-fit h-fit">

            <!-- Modal Header -->
            <div class="flex items-center justify-center mb-5">
                <b><h5 class="text-2xl font-bold modal-title" id="exampleModalLabel">Change Password</h5></b>
            </div>

            <!-- Modal Body -->
            <form action="updatefont.php" method="POST">

                <div class="flex flex-col gap-2 mt-5"> 
                    <div class="mb-5 font-medium">
                        <label  class="ml-1">Please select your user type and enter new password</label>
                    </div>

                    <input type="hidden" value="<?php 
                        if(isset($_SESSION['froget_email_send'])){ 
                            echo $_SESSION['froget_email_send'];
                        }; 
                    ?>" name="email" required>

                    <div class="flex flex-col gap-1 font-bold">
                        <label for="usertype"  class="ml-1">Select your user type</label>
                        <select name="usertype" id="usertype" placeholder="E.g. your farmer select “farmer”" class="rounded-lg border border-slate-300 h-10 bg-[#f3f2f2] w-60" required>
                            <option disabled selected >Please choose your user type</option>
                            <option value="farmer" name="usertype" >Farmer</option>
                            <option value="customer" name="usertype">Customer</option>
                            <option value="supplier" name="usertype">Supplier</option>
                        </select>
                    </div>

                    <div class="flex gap-2 font-bold">
                        <div class="flex flex-col gap-1">
                            <label for="new_password" class="ml-1">New Password</label>
                            <input type="text" id="new_password" name="new_password" class="h-10 p-1 border-2 rounded-lg w-60 border-slate-300" required>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="confirm_password" class="ml-1">Confirm Password</label>
                            <input type="text" id="confirm_password" name="confirm_password" class="h-10 p-1 border-2 rounded-lg w-60 border-slate-300" required>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-4 text-center">
                    <button type="button" id="password_close" class="w-24 text-white transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                    <button type="submit" name="update_password" id="update_password"  class="w-24 text-white transition bg-blue-500 rounded-lg h-9 hover:bg-blue-600">Update</button>
                </div>

            </form>

        </div>
    </div>

    <?php

        if(isset($_POST['otp_verify'])){
            if($_SESSION['froget_otp_send'] == $_POST['otp_number']){
                unset($_SESSION['froget_otp_send']);
                echo '<script>
                    document.getElementById("otp_modal").style.display = "none";
                    document.getElementById("password_modal").style.display = "block";
                </script>';
            }
            else{
                $_SESSION['login_message'] = "Your OTP number is incorrect";
                echo '<script>
                    window.reload();
                </script>';
                exit(0);
            }
        }
    ?>
 
    <!-- sweetalert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- modal hide nad view js code -->
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

        });
    </script>

    <!-- toggle password visibility -->
    <script>
        // toggle password visibility script
        let toggleImg =document.getElementById('toggleImg');
        var password = document.getElementById('password');

        toggleImg.addEventListener('click', function() {
            if (password.type === 'password') {
                password.type = 'text';
                toggleImg.src = 'images/eye-open.png';
                toggleImg.style.height = '14px';
            } else {
                password.type = 'password';
                toggleImg.src = 'images/eye-close.png';
                toggleImg.style.height = '16px';
            }
        });
    </script>

    <!-- show output message -->
    <script>
        var message ="<?php echo isset($_SESSION['login_message']) ? $_SESSION['login_message'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.
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
            <?php unset($_SESSION['login_message']); ?>
        } 
    </script>

</body>
</html>