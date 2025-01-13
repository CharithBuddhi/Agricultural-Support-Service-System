<?php session_start(); 
if(!isset($_SESSION['login_staff_user'])){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/src/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    
</head>
<body class="bg-[#305dc7] text-white">

    <div class="flex w-full h-screen">

        <!-- load staff menu bar here -->
        <div class="load_data_container w-[20%]"></div> 

        <div class="flex flex-col w-[79%] rounded-3xl pl-2 ml-4 gap-5 ">

            <!-- user information form -->
            <form action="update.php" method="post" class="flex flex-col mt-14 ">
                <h1 class="text-2xl font-bold">User information</h1><hr class="w-[90%]">
                
                <?php
                    require('db_conn.php');

                    $requ = $_SESSION['login_staff_user'];
                    $sql = "SELECT * FROM `staff` WHERE `staff_userName` = '$requ'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                        
                    ?>

                    <input type="text" name="user_id" value="<?php echo $row['staff_id']; ?>" hidden readonly>
                    <div class="flex gap-32 mt-5 text-lg">
                        <div class="flex flex-col gap-2">
                            <h1 class="font-semibold">User name</h1>
                            <input type="text" value="<?php echo $row['staff_userName']; ?>" class="rounded-lg text-base h-7 w-[280px] pl-2 text-black disabled:bg-slate-300" disabled>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="font-semibold">Name</h1>
                            <input type="text" name="name" value="<?php echo $row['staff_name']; ?>" class="rounded-lg text-base h-7 w-[280px] pl-2 text-black disabled:bg-slate-300" disabled>
                        </div>
                    </div>

                    <div class="flex gap-32 mt-10 text-lg">
                        <div class="flex flex-col gap-2">
                            <h1 class="font-semibold">Position</h1>
                            <input type="text" value="<?php echo $row['staff_type']; ?>" class="rounded-lg text-base h-7 w-[280px] pl-2 text-black disabled:bg-slate-300" disabled>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="font-semibold">Email Address</h1>
                            <input type="email" name="email" value="<?php echo $row['staff_email']; ?>" class="rounded-lg text-base h-7 w-[280px] pl-2 text-black" required>
                        </div>
                    </div>

                    <?php
                
                ?>

                <div class="flex gap-4 mt-7">
                    <button type="submit" name="staff_profile_update_btn" class="px-3 py-1 text-white bg-purple-700 rounded-lg hover:bg-purple-500">Update</button>
                    <button type="reset" class="px-3 py-1 text-white rounded-lg bg-slate-400 hover:bg-slate-300">Cancel</button>
                </div>
            </form>

            <!-- password change form -->
            <form action="update.php" method="post" class="flex flex-col mt-2">
                <h1 class="text-2xl font-bold">Password Change</h1><hr class="w-[90%]">
                <div class="flex flex-col gap-8 mt-5 text-lg">
                <input type="text" name="user_id" value="<?php echo $row['staff_id']; ?>" hidden readonly>
                    <div class="flex flex-col gap-2">
                        <h1 class="font-semibold">Old Password</h1>
                        <input type="text" name="old_password" class="rounded-lg text-base h-7 w-[280px] pl-2 text-black"  required>
                    </div>
                    <div class="flex gap-32">
                        <div class="flex flex-col gap-2">
                            <h1 class="font-semibold">New Password</h1>
                            <div class="relative flex items-center">
                                <input type="password" id="password1" name="new_password" class="rounded-lg w-[280px] text-base h-7 pl-2 text-black" required>
                                <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg1">
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="font-semibold">Confirm Password</h1>
                            <div class="relative flex items-center">
                                <input type="password" id="password" name="confirm_password" class="rounded-lg w-[280px] text-base h-7 pl-2 text-black" required>
                                <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg">
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" name="staff_password_update_btn" class="px-3 py-1 text-white bg-purple-700 rounded-lg h-9 hover:bg-purple-500">Update</button>
                        <button type="reset" class="px-3 py-1 text-white rounded-lg h-9 hover:bg-slate-300 bg-slate-400">Cancel</button>
                    </div>
                </div>
            </form>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- load side menu bar  -->
    <script>
        $(document).ready(function(){
            $('.load_data_container').load('sendcode/satffpanel.php');
        })
    </script>

    <script>
        var message ="<?php echo isset($_SESSION['profile_status']) ? $_SESSION['profile_status'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.

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
            <?php unset($_SESSION['profile_status']); ?>
        } 
    </script>

    <script>
        // toggle password visibility script
        let toggleImg =document.getElementById('toggleImg');
        var password = document.getElementById('password');
        var toggleImg1 =document.getElementById('toggleImg1');
        var password1 = document.getElementById('password1');

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

        toggleImg1.addEventListener('click', function() {
            if (password1.type === 'password') {
                password1.type = 'text';
                toggleImg1.src = 'images/eye-open.png';
                toggleImg1.style.height = '14px';
            } else {
                password1.type = 'password';
                toggleImg1.src = 'images/eye-close.png';
                toggleImg1.style.height = '16px';
            }
        });
    </script>

</body>
</html>