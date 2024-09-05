<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>User Registration</title>

</head>
<body class="bg-cover bg-no-repeat bg-[url('images/reg.jpg')]">
    
    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <!-- registration form -->
    <div class="flex flex-col items-center mr-[250px]">
        <div class="flex flex-col items-center mt-3">
            <h2 class="mb-3 text-3xl font-semibold text-white">Register for your MyAgro account</h2>
        </div>
        <form id="registrationform" action="connect.php" method="POST" class="flex flex-col items-center font-semibold border rounded-3xl w-[350px] bg-[#D9D9D9]/80">
            <!-- common field -->
            <div class="flex flex-col w-[330px]" id="commonfield">
                <label for="name" class="mt-1">Enter your name</label>
                <input type="text" pattern="[a-zA-Z\s]+" minlength="15" id="name" name="yourname" placeholder=" E.g. charitha buddhika " class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <label for="username" class="mt-2">Enter your Username</label>
                <input type="text" placeholder=" E.g. charitha" minlength="5" id="username" name="username" class="rounded-md h-7 placeholder:italic placeholder:text-[14px]" required>
                <label for="password" class="mt-2">Enter your Password</label>
                <div class="relative flex items-center">
                    <input type="password" placeholder=" pick up your password" id="password" name="password" class=" rounded-md h-7 placeholder:italic placeholder:text-[14px] w-full" required>
                    <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg">
                </div> 
                <label for="userType" class="mt-2">Select your user type</label>
                <select name="userType" id="userType" class="mb-2 rounded-lg h-7 placeholder:italic placeholder:text-[14px]" required>
                    <option value="" disabled selected>Please choose your user type</option>
                    <option value="Customer">Customer</option>
                    <option value="Farmer">Farmer</option>
                    <option value="Supplier">Supplier</option>
                </select>
            </div>

            <!-- Customer Fields -->
            <div class="user-type-section hidden flex flex-col w-[330px]" id="Customerfield">
                <label for="customerAddress">Enter your address</label>
                <input type="text" id="customerAddress" name="address" placeholder=" E.g. No 250/3, Colombo Road, Kandy" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <label for="customerEmail" class="mt-2">Enter your Email Address</label>
                <input type="email" id="customerEmail" name="email" placeholder=" E.g. charit@gmail.com" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <label for="customerPhone" class="mt-2">Enter your phone number</label>
                <input type="tel" id="customerPhone" name="phone" pattern="[0-9]{10}" placeholder=" E.g. 0795555555" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <div class="flex">
                    <button type="reset" class="mt-6 mr-6 h-8 rounded-full w-[145px] bg-[#6EE70F]/50">Clear</button>
                    <input type="submit" value="Register" class=" mt-6 h-8 rounded-full w-[160px] bg-[#6EE70F]/50 text-[#f9e912]">
                </div>
                <h1 class="relative mt-5 mb-2 text-sm left-10">Already have an account? <a href="login.php">Login</a></h1>
            </div>

            <!-- Farmer Fields -->
            <div class="user-type-section hidden flex flex-col w-[330px]" id="Farmerfield">
                <label for="farmerNIC">Enter your NIC number</label>
                <input type="text" id="farmerNIC" pattern="\d+" maxlength="12" minlength="9" placeholder=" E.g. 458458756789 or 258963147(without v,x)" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic"  required>
                <label for="farmerAddress" class="mt-2">Enter your address</label>
                <input type="text" id="farmerAddress" placeholder=" E.g. No 250/3, Colombo Road, Kandy" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <label for="farmerEmail" class="mt-2">Enter your Email Address</label>
                <input type="email" id="farmerEmail" placeholder=" E.g. charit@gmail.com" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <label for="farmerPhone" class="mt-2">Enter your phone number</label>
                <input type="tel" id="farmerPhone" pattern="[0-9]{10}" placeholder=" E.g. 0795555555" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <label for="farmerProof" class="mt-2">Enter your proof image</label>
                <input type="file" accept="image/*" id="farmerProof" class="rounded-md h-[70px] border-4 placeholder:text-[14px] placeholder:italic" required>
                <div class="flex">
                    <button type="reset" class="mt-6 h-8 mr-6 rounded-full w-[145px] bg-[#6EE70F]/50">Clear</button>
                    <button type="submit" class="mt-6 h-8 rounded-full w-[160px] bg-[#6EE70F]/50 text-[#f9e912]">Register</button>
                </div>
                <h1 class="relative mt-5 mb-2 text-sm left-10">Already have an account? <a href="login.php">Login</a></h1>
            </div>

            <!-- Supplier Fields -->
            <div class="user-type-section hidden flex flex-col w-[330px]" id="Supplierfield">
                <label for="supplierNIC">Enter your NIC number</label>
                <input type="text" pattern="\d+" maxlength="12" minlength="9" id="supplierNIC" placeholder=" E.g. 458458756789 or 258963147(without v,x)" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <label for="supplierAddress" class="mt-2">Enter your address</label>
                <input type="text" id="supplierAddress" placeholder=" E.g. No 250/3, Colombo Road, Kandy" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <label for="supplierEmail" class="mt-2">Enter your Email Address</label>
                
                <input type="email" id="supplierEmail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" placeholder=" E.g. charit@gmail.com" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                
                <label for="supplierOTP" class="mt-2">Enter your OTP number</label>
                <input type="text" id="supplierOTP" pattern="[0-9]{4}" placeholder=" E.g. 0123" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <label for="supplierPhone" class="mt-2">Enter your phone number</label>
                <input type="tel" id="supplierPhone" pattern="[0-9]{10}" placeholder=" E.g. 0795555555" class="rounded-md h-7 placeholder:text-[14px] placeholder:italic" required>
                <label for="supplierProof" class="mt-2">Enter your proof image</label>
                <input type="file" accept="image/*" id="supplierProof" class="rounded-md h-[70px] border-4 placeholder:text-[14px] placeholder:italic" required>
                <div class="flex">
                    <button type="reset" class="mt-5 mr-6 h-8 rounded-full w-[145px] bg-[#6EE70F]/50">Clear</button>
                    <button type="submit" class="mt-5 h-8 rounded-full w-[160px] bg-[#6EE70F]/50 text-[#f9e912]">Register</button>
                </div>
                <h1 class="relative mt-4 text-sm left-10">Already have an account? <a href="login.php">Login</a></h1>
                <button class="absolute top-[480px] left-[700px]">
                    <input type="submit" value="Send OTP" name="emailSubmit" class="h-8 rounded-full w-[150px] bg-[#6EE70F]/50 focus:cursor-pointer">
                </button>
            </div>
        </form>
    </div>


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

        // user type selection script
        document.getElementById('userType').addEventListener('change', function () {
            var userType = this.value;
            var sections = document.querySelectorAll('.user-type-section');
            sections.forEach(function (section) {
                section.classList.add('hidden');
            });
            if (userType) {
                document.getElementById(userType + 'field').classList.remove("hidden");
                document.getElementById(userType + 'field').classList.remove("hidden");
                document.getElementById(userType + 'field').classList.remove("hidden");
                document.getElementById(userType + 'field').classList.remove("hidden");
                document.getElementById(userType + 'field').classList.remove("hidden");
                document.getElementById(userType + 'field').classList.remove("hidden");
                document.getElementById(userType + 'field').classList.remove("hidden");
            }
        });


        
    </script>

</body>
</html>
