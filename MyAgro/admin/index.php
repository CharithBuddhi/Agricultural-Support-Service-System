<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
</head>
<body class="bg-cover bg-no-repeat bg-[url('images/login.jpg')]">
    <!-- login form -->
    <div >
        <div class="flex flex-col gap-5 items-center h-[63vh] w-[60%] mx-auto mt-40 rounded-3xl shadow-2xl drop-shadow-2xl bg-[#BAEAD3]/50">
            <h1 class="font-serif italic text-6xl mb-6 font-bold text-[#30f915]">MyAgro</h1>
            <div class="p-3 border-1 rounded-3xl ">
                <h1 class="mb-4 text-3xl font-bold text-center">Login</h1>
                <div class="flex flex-col items-center">
                    <form action="" class="flex flex-col font-semibold w-[300px]">
                        <label for="username" class="mt-4">Enter your Username</label>
                        <input type="text" placeholder=" E.g.charitha" id="username"class="pl-1 rounded-lg h-7 placeholder:italic" required>
                        <label for="password" class="mt-4">Enter your Password</label>
                        <div class="relative flex items-center">
                            <input type="password" placeholder=" pick up your password" id="password" class="w-full pl-1 rounded-lg h-7 placeholder:italic" required>
                            <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg">
                        </div>
                        <a href="admin.php" class="flex mt-6 h-10 rounded-full bg-[#E8E025] justify-center">
                            <input type="submit" value="Login"  class="py-2 focus:cursor-pointer">
                        </a>
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