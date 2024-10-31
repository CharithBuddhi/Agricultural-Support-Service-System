<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>User Registration</title>
    <style>
        label{font-weight: 600;}
    </style>

</head>
<body>
    
    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <!-- registration form customer -->
    <div class="flex flex-col items-center pr-[250px] bg-cover bg-no-repeat bg-[url('images/reg.jpg')]">
        <div class="flex flex-col items-center mt-3">
            <h2 class="mb-3 text-3xl font-semibold text-white">Register for your MyAgro account</h2>
        </div>
        <form action="connect.php" method="POST" class="flex flex-col items-center border rounded-3xl w-[350px] bg-[#D9D9D9]/80">
            <div class="flex flex-col w-[330px]" id="commonfield">

                <label for="username" class="mt-[140px]">Enter your Username</label>
                <input type="text" placeholder=" E.g. charitha" minlength="5" id="username" name="username" class="rounded-md p-1 font-semibold h-8 placeholder:italic placeholder:text-[14px]" required>

                <label for="password" class="mt-2">Enter your Password</label>
                <div class="relative flex items-center">
                    <input type="password" placeholder=" pick up your password" id="password" name="password" class="p-1 rounded-md font-semibold h-8 placeholder:italic placeholder:text-[14px] w-full" required>
                    <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg">
                </div> 

                <label for="usertype" class="mt-2">Select your user type</label>
                <select name="usertype" id="usertype" class="rounded-lg font-semibold p-1 h-8 placeholder:italic text-[14px]" required>
                    <option value="customer" class="text-[14px]">Customer</option>
                </select>

                <label for="customerAddress" class="mt-2">Enter your address</label>
                <input type="text" id="customerAddress" name="address" placeholder=" E.g. No 250/3, Colombo Road, Kandy" class="rounded-md p-1 font-semibold h-8 fill:bg-black placeholder:text-[14px] placeholder:italic" required>

                <div class="mt-2">
                    <label for="supplierOTP" class="mt-2">Enter your OTP number</label>
                    <input name="verify_otp" pattern="\d+" type="text" id="verify_otp" maxlength="4" placeholder=" E.g. 0123" class="rounded-md p-1 font-semibold w-[225px] h-8 px-1 placeholder:text-[14px] placeholder:italic" required>
                    <button name="verify_btn" id="verify_btn" type="button" class="text-sm font-semibold rounded-md w-[100px] h-8 mt-1 bg-[#6EE70F]/80  focus:cursor-pointer self-end hover:text-[#000000] text-[#ffffff]">Verify OTP</button>
                </div>

                <label for="customerPhone" class="mt-2">Enter your phone number</label>
                <input type="tel" id="customerPhone" name="phone" pattern="[0-9]{11}" placeholder=" E.g. 94795555555" class="rounded-md p-1 font-semibold h-8 placeholder:text-[14px] placeholder:italic" required>
                
                <div class="flex">
                    <button type="reset" class="mt-6 mr-6 h-8 rounded-full font-semibold w-[145px] bg-[#6EE70F]/80 hover:bg-lime-300 hover:text-[#000000] text-[#ffffff]">Clear</button>
                    <button type="submit" id="request_btn" name="register" class=" mt-6 h-8 font-semibold disabled:bg-[#6EE70F]/40 rounded-full w-[160px] bg-[#6EE70F]/80 hover:bg-lime-300 hover:text-[#000000] text-[#ffffff]">Register</button>
                </div>
                <h1 class="relative mt-4 mb-2 text-sm left-10">Already have an account? <a href="login.php">Login</a></h1>
            
            </div>

        </form>

        <form action="sendmail.php" method="POST" class="relative flex flex-col bottom-[620px]">

            <label for="name" class="mt-2">Enter your name</label>
            <input type="text" pattern="[a-zA-Z\s]+" minlength="8" id="aname" value="<?php if(isset($_GET['yourname'])){ echo $_GET['yourname']; } ?>" name="yourname" placeholder=" E.g. charitha buddhika " class="rounded-md p-1 font-semibold h-8 placeholder:text-[14px] placeholder:italic" required>

            
            <label for="email" class="mt-2">Enter your Email Address</label>
            <div class="flex gap-1">
                <input type="email" id="email" name="email" placeholder=" E.g. charit@gmail.com" value="<?php if(isset($_GET['email'])){ echo $_GET['email']; } ?>" class="rounded-md p-1 font-semibold w-[225px] h-8 placeholder:text-[14px] placeholder:italic" required>
                <button name="email_btn" id="email_btn" class="font-semibold text-sm rounded-md w-[100px] h-8 bg-[#6EE70F]/80 focus:cursor-pointer self-end hover:text-[#000000] text-[#ffffff]">Send OTP</button>    
            </div>
        </form>

        <!-- load side manu bar in registration form -->
        <div class="load_data_container">    
        </div>

    </div>

    <!-- footer section in home page -->
    <?php require('footer.php'); ?>

    <!-- "verify otp code correct or not" -->
    <script> 
        const request_btn = document.getElementById("request_btn");
        request_btn.disabled = true;
        const verify_otp = document.getElementById("verify_otp");
        const verify_btn = document.getElementById("verify_btn");

        var otp_value = "<?php echo $_SESSION['otp']; ?>";
        
        verify_btn.addEventListener("click", () => {
            if (otp_value !== "") {
                if (verify_otp.value == otp_value) {
                    alert("OTP verified successfully");
                    request_btn.disabled = false;  
                } else {
                    alert("Incorrect OTP");
                    request_btn.disabled = true;
                }
                <?php unset($_SESSION['otp']); ?>
            }
        });
        
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- sweetalert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- call registration.js -->
    <script src="javascript/registration.js"></script>

    <!-- load menu bar code -->
    <script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/register.php');
    })
    </script>

    <!-- toggle password visibility script -->
    <script>

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
    var message ="<?php echo isset($_SESSION['reg_message']) ? $_SESSION['reg_message'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.
        if (message != "") {
            if(message.includes('success')) {
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
                background: "#fcf2f2",
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
            <?php unset($_SESSION['reg_message']); ?>
        } 
    </script>

</body>
</html>
