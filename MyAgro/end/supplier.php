<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        label{font-weight: 600;}
    </style>

</head>
<body class="bg-cover bg-no-repeat bg-[url('images/reg.jpg')]">
    
    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <!-- registration form -->
    <div class="flex flex-col items-center mr-[250px]">
        <div class="flex flex-col items-center mt-3">
            <h2 class="mb-3 text-3xl font-semibold text-white">Register for your MyAgro account</h2>
        </div>
        <form id="registrationform" action="#" method="POST" class="flex flex-col items-center text-md border rounded-3xl w-[350px] bg-[#D9D9D9]/80">

            <div class="flex flex-col w-[330px]" id="commonfield">
                <label for="name" class="mt-1">Enter your name</label>
                <input type="text" pattern="[a-zA-Z\s]+" minlength="15" id="aname" name="yourname" placeholder=" E.g. charitha buddhika" class="rounded-md h-7  px-1 placeholder:text-[14px] placeholder:italic" required>
                
                <label for="username" class="mt-2">Enter your Username</label>
                <input type="text" placeholder=" E.g. charitha" minlength="5" id="username" name="username" class="rounded-md h-7 px-1 placeholder:italic placeholder:text-[14px]" required>
                
                <label for="password" class="mt-2">Enter your Password</label>
                <div class="relative flex items-center">
                    <input type="password" placeholder=" pick up your password" id="password" name="password" class=" rounded-md h-7 px-1 placeholder:italic placeholder:text-[14px] w-full" required>
                    <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg">
                </div> 
                
                <label for="usertype" class="mt-2">Select your user type</label>
                <select name="usertype" id="usertype" class="rounded-lg h-7  px-1 text-[14px]" >
                    <option value="supplier" class="text-[14px]">Supplier</option>
                </select>

                <label for="supplierNIC"  class="mt-2">Enter your NIC number</label>
                <input type="text" pattern="\d+" maxlength="12" minlength="9" id="supplierNIC" placeholder=" E.g. 458458756789 or 258963147(without v,x)" class="rounded-md h-7 px-1 placeholder:text-[14px] placeholder:italic" required>
                
                <label for="supplierAddress" class="mt-2">Enter your address</label>
                <input type="text" id="supplierAddress" placeholder=" E.g. No 250/3, Colombo Road, Kandy" class="rounded-md h-7 placeholder:text-[14px] px-1 placeholder:italic" required>
                
                <div class="flex flex-col ">
                    <label for="supplierEmail" class="mt-2">Enter your Email Address</label>
                    <input type="email" id="email" placeholder=" E.g. charit@gmail.com" class="rounded-md font-semibold px-1 h-7 placeholder:text-[14px] placeholder:italic" required>
                    <button name="email_btn" id="email_btn" class="h-6 font-semibold text-sm rounded-md w-[100px] mt-1 bg-[#6EE70F]/50 focus:cursor-pointer self-end">Send OTP</button>
                </div>
                
                <div class="flex flex-col ">
                    <label for="supplierOTP" class="mt-2">Enter your OTP number</label>
                    <input name="verify_otp" type="text" id="verify_otp" pattern="[0-9]{4}" placeholder=" E.g. 0123" class="rounded-md h-7 px-1 placeholder:text-[14px] placeholder:italic" required>
                    <button name="verify_btn" id="verify_btn" type="submit" class="h-6 text-sm font-semibold rounded-md w-[100px] mt-1 bg-[#6EE70F]/50  focus:cursor-pointer self-end">Verify OTP</button>
                </div>
                
                <label for="supplierPhone" class="mt-2">Enter your phone number</label>
                <input type="tel" id="supplierPhone" pattern="[0-9]{10}" placeholder=" E.g. 0795555555" class="rounded-md h-7 px-1 placeholder:text-[14px] placeholder:italic" required>
                
                <label for="supplierProof" class="mt-2">Enter your proof image</label>
                <input type="file" accept="image/*" id="supplierProof" class="rounded-md h-[70px] border-4 placeholder:text-[14px] px-1 placeholder:italic" required>
                
                <div class="flex">
                    <button type="reset" class="mt-5 mr-6 h-8 rounded-full font-semibold w-[145px] bg-[#6EE70F]/50">Clear</button>
                    <button type="submit" id="request_btn" class="mt-5 h-8 rounded-full w-[160px] bg-[#6EE70F]/50 font-semibold disabled:bg-[#6EE70F]/30 text-yellow-300 active:bg-pink-600">Request</button>
                </div>
                
                <h1 class="relative mt-4 mb-2 text-sm left-10">Already have an account? <a href="login.php">Login</a></h1>
                
                
            
            </div>
        </form>

        <!-- shapes -->
        <div class="border-4 border-red-700 ">
            <p class="absolute top-[160px] left-[2px] text-xl font-semibold text-white">Select your user type</p>
            <a href="customer.php">
                <div class="absolute gap-1 flex w-[220px] h-[80px] rounded-2xl bg-white top-[200px] left-[-10px] border-2 justify-center border-cyan-500 hover:border-4  hover:border-teal-300 text-xl hover:w-[250px]">
                    <label for="" class="mt-5 font-serif">Customer</label>
                    <img src="images/customer.png" alt="cus" class="w-[40px] h-[40px] mt-4">
                </div>
            </a>
            <a href="farmer.php">
                <div class="absolute gap-5 flex w-[220px] h-[80px] rounded-2xl bg-white top-[280px] left-[-10px] border-2 justify-center border-cyan-500 hover:border-4  hover:border-teal-300 text-xl hover:w-[250px]">
                    <label for="" class="mt-5 font-serif">Farmer</label>
                    <img src="images/farmer.png" alt="cus" class="w-[40px] h-[40px] mt-4">
                </div>
            </a>
            <a href="supplier.php">
                <div class="absolute gap-1 flex w-[220px] h-[80px] rounded-2xl bg-white top-[360px] left-[-10px] border-2 justify-center border-cyan-500 hover:border-4  hover:border-teal-300 text-xl hover:w-[250px]">
                    <label for="" class="mt-5 font-serif">Supplier</label>
                    <img src="images/supplier.png" alt="cus" class="w-[40px] h-[40px] mt-4">
                </div>
            </a>
            
        </div>

    </div>

    <!-- toast massage pop -->
    <div id="popup" class="absolute top-5 h-[75px] right-5 justify-end w-[370px] hidden">
        <div class="flex border-l-8 border-green-400 rounded shadow-xl mt-5 h-[75px] items-center mr-5 w-[370px] bg-white">
            <i class="fas fa-solid fa-check ml-2 rounded-full w-[30px] h-[30px] bg-green-400 align-center items-center justify-center flex text-white"></i>
            <div class="flex flex-col ml-4">
                <label class="font-bold">Successfull</label> 
                <label class="text-sm">Your has been successfully requested</label> 
            </div>
            <div class="absolute top-6 right-2">
                <button type="button" onclick="closePopup()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-500 size-4 hover:text-gray-900">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg> 
                </button>             
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- call registration.js -->
    <script src="javascript/registration.js"></script>
    <!-- sweetalert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <!-- remvoe success massage after display -->   
    <script>
        let popup = document.getElementById('popup');

        function openPopup(){
            popup.classList.remove('hidden');
            
        }
        function closePopup(){
            popup.classList.add('hidden');
        }
    </script>
    
</body>
</html>
