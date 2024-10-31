<?php session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body class="bg-cover bg-no-repeat bg-[url('images/login.jpg')]">
    <!-- login form -->
    <div >
        <div class="flex flex-col gap-5 items-center h-[63vh] w-[60%] mx-auto mt-40 rounded-3xl shadow-2xl drop-shadow-2xl bg-[#BAEAD3]/50">
            <h1 class="font-serif italic text-6xl mb-6 font-bold text-[#30f915]">MyAgro</h1>
            <div class="p-3 border-1 rounded-3xl ">
                <h1 class="mb-4 text-3xl font-bold text-center">Login</h1>
                <div class="flex flex-col items-center">
                    <form action="login_check.php" method="post" class="flex flex-col font-semibold w-[300px]">
                        <label for="username" class="mt-4">Enter your Username</label>
                        <input type="text" placeholder=" E.g.charitha" id="username" name="username" class="pl-1 rounded-lg h-9 placeholder:italic" required>
                        <label for="password" class="mt-4">Enter your Password</label>
                        <div class="relative flex items-center">
                            <input type="password" placeholder="pick up your password" name="password" id="password" class="w-full pl-1 rounded-lg h-9 placeholder:italic" required>
                            <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg">
                        </div>
                        <button type="submit" name="login" class="mt-6 h-10 focus:cursor-pointer rounded-full bg-[#E8E025] text-center">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="js/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

<script>
    // Set the minimum width in pixels for tablets or higher (e.g., 768px for most tablets)
    var minWidth = 768;

    // Check if the screen width is less than the minimum width
    if (window.innerWidth < minWidth) {
        // Redirect to a warning page or block access
        window.location.href = "access-denied.html";  // Redirect to a warning page
    }
</script>


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

<script>
// show inquiry reply success or error message
var message = "<?php echo isset($_SESSION['login_status']) ? $_SESSION['login_status'] : ''; ?>"; //send status include massage  varible message, but if not status then print ''.

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
        <?php unset($_SESSION['login_status']); ?>
    }   
</script>

</body>
</html>