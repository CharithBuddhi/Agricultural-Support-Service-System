<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>Login page</title>
</head>
<body class="h-[81vh] bg-cover bg-no-repeat bg-[url('images/login.jpg')]">

    <!-- navigation bar -->
    <?php require('header.php'); ?>
    
    <!-- login form -->
    <div >
        <div class="flex flex-col items-center h-[63vh] w-[60%] mx-auto mt-40 rounded-3xl shadow-2xl bg-[#BAEAD3]/50">
            <h1 class="font-serif text-6xl mb-6 italic font-bold text-[#30f915]">MyAgro</h1>
            <div class="p-3 border-1 rounded-3xl shadow-2xl bg-[#BAEAD3]/60">
                <h1 class="mb-10 text-3xl font-bold">Log in to your MyAgro account</h1>
                <div class="flex flex-col items-center">
                    <form action="" class="flex flex-col font-semibold w-[300px]">
                        <label for="userType">Select your user type</label>
                        <select name="" id="userType" placeholder="E.g. your farmer select “farmer”" class="rounded-lg h-7 placeholder:italic bg-[#f3f2f2]" required>
                            <option value="def" disabled selected >Please choose your user type</option>
                            <option value="Farmer" >Farmer</option>
                            <option value="Customer">Customer</option>
                            <option value="Supplier">Supplier</option>
                        </select>
                        <label for="username" class="mt-4">Enter your Username</label>
                        <input type="text" placeholder=" E.g.charitha" id="username"class="pl-1 rounded-lg h-7 placeholder:italic" required>
                        <label for="password" class="mt-4">Enter your Password</label>
                        <div class="relative flex items-center">
                            <input type="password" placeholder=" pick up your password" id="password" class="w-full pl-1 rounded-lg h-7 placeholder:italic" required>
                            <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg">
                        </div>
                        <p class="relative mt-1 left-[172px]">
                            <a href="forgot.html">Forgot Password?</a>
                        </p>
                        <button class="flex mt-6 h-10 rounded-full bg-[#E8E025] justify-center">
                            <input type="submit" value="Login" class="py-2 focus:cursor-pointer">
                        </button>
                        <p class="relative mt-3 left-8">Don't have an account? <a href="customer.php">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
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
    </script>

</body>
</html>