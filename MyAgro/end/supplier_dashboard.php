<?php 
session_start();
if(!isset($_SESSION['login_id'])){
    header("Location: login.php");
    exit();
}
require('db_connect.php');

// cutomer details update php code
if(isset($_POST['update_profile_btn'])){

    $profile_picture = $_FILES['profile_picture']['name'];
    $query = "SELECT * FROM supplier WHERE supplier_id = '$_SESSION[login_id]' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $supplier_name = $row['supplier_name'];
    $supplier_email = $row['supplier_email'];
    $supplier_address = $row['supplier_address'];
    $supplier_phone = $row['supplier_phone'];
    $bank_name = $row['bank_name'];
    $account_name = $row['account_name'];
    $account_no = $row['account_no'];
    $branch_name = $row['branch_name'];
    $db_Profile_image = $row['images'];

    if($supplier_name == $_POST['supplier_name'] && $supplier_email == $_POST['supplier_email'] && $supplier_address == $_POST['supplier_address'] && $supplier_phone == $_POST['supplier_phone'] && $bank_name == $_POST['bank_name'] && $account_name == $_POST['account_name'] && $account_no == $_POST['account_no'] && $branch_name == $_POST['branch_name'] && $profile_picture == ""){
        $_SESSION['supplier_profile_update'] = "You are not change your details";
        header("Location: supplier_dashboard.php");
        exit(0);
        
    }else if(!($supplier_name == $_POST['supplier_name']) || !($supplier_email == $_POST['supplier_email']) || !($supplier_address == $_POST['supplier_address']) || !($supplier_phone == $_POST['supplier_phone']) || !($bank_name == $_POST['bank_name']) || !($account_name == $_POST['account_name']) || !($account_no == $_POST['account_no']) || !($branch_name == $_POST['branch_name']) || !($profile_picture == "")){
        
        $id = $_SESSION['login_id'];
        $yourname = $_POST['supplier_name'];
        $address = $_POST['supplier_address'];
        $email = $_POST['supplier_email'];
        $phone = $_POST['supplier_phone'];
        $bank_name = $_POST['bank_name'];
        $account_name = $_POST['account_name'];
        $account_no = $_POST['account_no'];
        $branch_name = $_POST['branch_name'];
        
        if(!empty(trim($yourname)) || !empty(trim($address)) || !empty(trim($email)) || !empty(trim($phone))){
            
            if(!empty(trim($profile_picture))){

                $date_time = time();
                
                $image_temp_name = $_FILES['profile_picture']['tmp_name'];

                $profile_picture = $date_time . "_" . $_FILES['profile_picture']['name'];
                
                $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\end\\images\\user\\" . $profile_picture;   

                if($db_Profile_image == ""){

                    if(move_uploaded_file($image_temp_name,$image_destination)){
    
                        $UPDATE = "UPDATE supplier SET supplier_name = ?, supplier_email = ?, supplier_address = ?, supplier_phone = ?, bank_name = ?, account_name = ?, account_no = ?, branch_name = ?, images = ? WHERE supplier_id = ?";
                        $stmt = $conn->prepare($UPDATE);
                        $stmt->bind_param("sssisssssi", $yourname, $email, $address, $phone, $bank_name, $account_name, $account_no, $branch_name, $profile_picture, $id);
                        $_SESSION['supplier_profile_update'] = "Your informations update successfully!";
                        $stmt->execute();
                        $stmt->close();
                        $conn->close();
                        header("Location: supplier_dashboard.php");
                        exit();
                        
                    }else{
                        echo "Failed to upload file. Error: " . $_FILES['profile_picture']['error'];
                        $_SESSION['supplier_profile_update'] = "Your upload has been failed!";
                        header("Location: supplier_dashboard.php");
                        exit();
                    }
                    
                }else{

                    // this is previous profile image path used for unlink in update time
                    $filePath = 'images/user/' . $db_Profile_image;
        
                    // Delete the file from the server
                    if(file_exists($filePath)){ 
        
                        unlink($filePath);
    
                        if(move_uploaded_file($image_temp_name,$image_destination)){
    
                            $UPDATE = "UPDATE supplier SET supplier_name = ?, supplier_email = ?, supplier_address = ?, supplier_phone = ?, bank_name = ?, account_name = ?, account_no = ?, branch_name = ?, images = ? WHERE supplier_id = ?";
                            $stmt = $conn->prepare($UPDATE);
                            $stmt->bind_param("sssisssssi", $yourname, $email, $address, $phone, $bank_name, $account_name, $account_no, $branch_name, $profile_picture, $id);
                            $_SESSION['supplier_profile_update'] = "Your informations update successfully!";
                            $stmt->execute();
                            $stmt->close();
                            $conn->close();
                            header("Location: supplier_dashboard.php");
                            exit();
                            
                        }else{
                            echo "Failed to upload file. Error: " . $_FILES['profile_picture']['error'];
                            $_SESSION['supplier_profile_update'] = "Your upload has been failed!";
                            header("Location: supplier_dashboard.php");
                            exit();
                        }
        
                    }else{
                        $_SESSION['supplier_profile_update'] = "Your previous profile image missing!";
                        header("Location: supplier_dashboard.php");
                        exit();
                    }
                }

            }else{
                $UPDATE = "UPDATE supplier SET supplier_name = ?, supplier_email = ?, supplier_address = ?, supplier_phone = ?, bank_name = ?, account_name = ?, account_no = ?, branch_name = ? WHERE supplier_id = ?";
                $stmt = $conn->prepare($UPDATE);
                $stmt->bind_param("sssissssi", $yourname, $email, $address, $phone, $bank_name, $account_name, $account_no, $branch_name, $id);
                $_SESSION['supplier_profile_update'] = "Your details Update successfully!";
                $stmt->execute();
                $stmt->close();
                $conn->close();
                header("Location: supplier_dashboard.php");
                exit();
            }
        }else{
            $_SESSION['supplier_profile_update'] = "Please fill your basic information";
            header("Location: supplier_dashboard.php");
            exit();  
        }

    }

}

// supplier_password_update_btn in profile
if(isset($_POST['supplier_password_update_btn'])){

    $id = $_POST['user_id'];
    $old_password= $_POST['old_password'];
    $new_password= $_POST['new_password'];
    $confirm_password= $_POST['confirm_password'];

    $check = "SELECT `password` FROM `supplier` WHERE supplier_id  = '$id'";
    $result = mysqli_query($conn, $check);
    $row = mysqli_fetch_assoc($result);
    $password = $row['password'];

    if($old_password==$password){

        if($old_password==$new_password){
            $_SESSION['supplier_profile_update'] = 'You are not change your password';
            header("Location: supplier_dashboard.php");
            exit(0);

        }else if($new_password!=$confirm_password){
            $_SESSION['supplier_profile_update'] = 'New password and confirm password not matched';
            header("Location: supplier_dashboard.php");
            exit(0);

        }else if($new_password==$confirm_password){
            $sql = "UPDATE `supplier` SET `password`='$confirm_password' WHERE supplier_id  = '$id'";
            $result1 = mysqli_query($conn, $sql);
            if($result1){
                $_SESSION['supplier_profile_update'] = 'Your password update successfully';
                header("Location: supplier_dashboard.php");
                exit(0);
            }
            else{
                $_SESSION['supplier_profile_update'] = 'Email address not update';
                header("Location: supplier_dashboard.php");
                exit(0);
            }
        }

    }else{
        $_SESSION['supplier_profile_update'] = 'Your Old password wrong';
        header("Location: supplier_dashboard.php");
        exit(0);
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <?php require('user_header.php'); ?>
    

    <div class="flex w-full h-screen">

        <div class="flex flex-col gap-5 pl-2 ml-4 rounded-3xl ">

            <!-- user information form -->
            <form action="" method="post" class="flex flex-col mt-8" enctype="multipart/form-data">
                
                <h1 class="h-8 mb-1 font-serif text-3xl font-bold w-fi">Personal Information</h1><hr class="w-[90%]">
                
                <?php

                    $supplier_id = $_SESSION['login_id'];
                    $sql = "SELECT * FROM supplier WHERE supplier_id = '$supplier_id' LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['profile_image'] = $row['images'];
                    ?>

                    <div class="flex flex-col mt-2">

                        <!-- change profile image -->
                        <div class="flex flex-col self-center mt-3">
                            <label for="profile_picture_input" class="cursor-pointer">
                                
                                <div id="user_profile_name" class="flex items-center justify-center w-40 h-40 font-serif text-6xl font-semibold text-green-400 border-2 rounded-full bg-slate-200 border-slate-300" >
                                    <?php  
                                    $name=$row['username'] ; 
                                    echo strtoupper($name[0]);
                                    ?>
                                </div>

                                <img id="user_profile" name="user_profile" src="images/user/<?php echo $row['images']; ?>" class="self-center w-40 h-40 border-2 rounded-full border-slate-300" alt="user_profile" style="display: none;">
                            
                            </label>
                            <input type="file" id="profile_picture_input" name="profile_picture" class="bg-red-500" accept="image/*" onchange="previewImage(event)" hidden>
                        </div>

                        <input type="text" name="user_id" value="<?php echo $row['supplier_id']; ?>" hidden>
                        
                        <label class="flex self-center gap-1 mt-2 text-xl font-semibold text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>
                            Active
                        </label>
                        
                        <div class="flex flex-wrap mt-4 text-lg">
                            
                            <div class="flex flex-col gap-1">
                                <h1 class="pl-1 font-semibold">User name</h1>
                                <input type="text" name="username" value="<?php echo $row['username']; ?>" class="rounded-lg text-base h-8 w-[280px] border-2 pl-2 disabled:bg-slate-50" disabled>
                            </div>
                            
                            <div class="flex flex-col gap-1 ml-10">
                                <h1 class="pl-1 font-semibold">Supplier Name</h1>
                                <input type="text" name="supplier_name" value="<?php echo $row['supplier_name']; ?>" class="rounded-md text-base border-2 pl-1 h-8 w-[300px]" required>
                            </div>

                            <div class="flex flex-col gap-1 ml-10">
                                <h1 class="pl-1 font-semibold">Shop Name</h1>
                                <input type="text" name="supplier_shop_name" value="<?php echo $row['supplier_shop_name']; ?>" class="rounded-lg text-base h-8 w-[280px] border-2 pl-2 disabled:bg-slate-50" disabled>
                            </div>

                            <div class="flex flex-col gap-1 ml-10">
                                <h1 class="pl-1 font-semibold">Supplier NIC</h1>
                                <input type="text" name="supplier_nic" value="<?php echo $row['supplier_nic']; ?>" class="rounded-lg text-base h-8 w-[250px] border-2 pl-2 disabled:bg-slate-50" disabled>
                            </div>

                            <div class="flex flex-col gap-1 mt-5">
                                <h1 class="pl-1 font-semibold">Email</h1>
                                <input type="email" name="supplier_email" value="<?php echo $row['supplier_email']; ?>" class="rounded-lg border-2 text-base h-8 w-[280px] pl-2" required>
                            </div>

                            <div class="flex flex-col gap-1 mt-5 ml-10">
                                <h1 class="pl-1 font-semibold">Address</h1>
                                <input type="text" name="supplier_address" value="<?php echo $row['supplier_address']; ?>" class="w-[300px] border-2 h-8 pl-2 text-base rounded-lg" required>
                            </div>

                            <div class="flex flex-col gap-1 mt-5 ml-10">
                                <h1 class="pl-1 font-semibold">Phone Number</h1>
                                <input type="text" maxlength="12" name="supplier_phone" value="<?php echo "+".$row['supplier_phone']; ?>" class="rounded-lg border-2 text-base h-8 w-[280px] pl-2" required>
                            </div>

                            <div class="flex flex-col gap-1 mt-5 ml-10">
                                <h1 class="pl-1 font-semibold">Bank Name</h1>
                                <input type="text" name="bank_name" value="<?php echo $row['bank_name']; ?>" class="w-[250px] border-2 h-8 pl-2 text-base rounded-lg">
                            </div>
                            
                            <div class="flex flex-col gap-1 mt-5">
                                <h1 class="pl-1 font-semibold">Branch Name</h1>
                                <input type="text" name="branch_name" value="<?php echo $row['branch_name']; ?>" class="w-[280px] border-2 h-8 pl-2 text-base rounded-lg">
                            </div>

                            <div class="flex flex-col gap-1 mt-5 ml-10">
                                <h1 class="pl-1 font-semibold">Acount Name</h1>
                                <input type="text" name="account_name" value="<?php echo $row['account_name']; ?>" class="w-[300px] border-2 h-8 pl-2 text-base rounded-lg">
                            </div>

                            <div class="flex flex-col gap-1 mt-5 ml-10">
                                <h1 class="pl-1 font-semibold">Account Number</h1>
                                <input type="text" name="account_no" value="<?php echo $row['account_no']; ?>" class="w-[280px] border-2 h-8 pl-2 text-base rounded-lg">
                            </div>

                        </div>
                        
                    </div>

                    <?php
                
                ?>

                <div class="flex gap-4 mt-5">
                    <button type="submit" name="update_profile_btn" class="px-3 py-1 w-[110px] text-white font-medium bg-purple-700 rounded-lg hover:bg-purple-500">Update</button>
                    <button type="reset" class="px-3 py-1 text-white w-[90px] rounded-lg bg-slate-400 font-medium hover:bg-slate-300">Clear</button>
                </div>
                
            </form>

            <!-- password change form -->
            <form action="" method="post" class="flex flex-col mt-2">

                <h1 class="text-2xl font-bold">Password Change</h1><hr class="w-[90%]">

                <div class="flex flex-col gap-4 mt-5 text-lg">

                    <input type="text" name="user_id" value="<?php echo $row['supplier_id']; ?>" hidden readonly>

                    <div class="flex flex-col gap-2">
                        <h1 class="font-semibold">Old Password</h1>
                        <input type="text" name="old_password" class="rounded-lg border-2 text-base h-8 w-[280px] pl-2"  required>
                    </div>

                    <div class="flex gap-28">
                        <div class="flex flex-col gap-2">
                            <h1 class="font-semibold">New Password</h1>
                            <div class="relative flex items-center">
                                <input type="password" id="password1" name="new_password" class="rounded-lg border-2 w-[280px] text-base h-8 pl-2" required>
                                <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg1">
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="font-semibold">Confirm Password</h1>
                            <div class="relative flex items-center">
                                <input type="password" id="password" name="confirm_password" class="rounded-lg border-2 w-[280px] text-base h-8 pl-2" required>
                                <img src="images/eye-close.png" alt="eye-colse.png" class="absolute w-5 h-4 cursor-pointer right-2 " id="toggleImg">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" name="supplier_password_update_btn" class="px-3 py-1 text-white bg-purple-700 rounded-lg h-9 hover:bg-purple-500">Update</button>
                        <button type="reset" class="px-3 py-1 text-white rounded-lg h-9 hover:bg-slate-300 bg-slate-400">Cancel</button>
                    </div>

                </div>
                
            </form>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- change profile image and preview image js code -->
    <script>
        const user_profile_name = document.getElementById('user_profile_name');
        const image = document.getElementById('user_profile');

        <?php 
            if($_SESSION['profile_image'] == Null) {
                ?>
                user_profile_name.style.display = "block";
                user_profile_name.style.display = "flex";
                user_profile_name.style.justifyContent = "center";
                user_profile_name.style.alignItems = "center";
                image.style.display = "none";
                <?php
            }else if($_SESSION['profile_image'] != Null) {
                ?>
                user_profile_name.style.display = "none";
                image.style.display = "block";
                <?php
            }
        ?>

        function previewImage(event) {
            user_profile_name.style.display = "none";
            image.style.display = "block";
            image.src = URL.createObjectURL(event.target.files[0]);
        }

    </script>

    <!-- show massage -->
    <script>
        var message ="<?php echo isset($_SESSION['supplier_profile_update']) ? $_SESSION['supplier_profile_update'] : ''; ?>"; //send supplier_profile_update include massage  varible message, but if not status then print ''.
        if (message != "") {
            if(message.includes('success')) {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                iconColor: "#69f44a",
                timer: 2000,
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
                timer: 2000,
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
            <?php unset($_SESSION['supplier_profile_update']); ?>
        } 
    </script>

    <!-- password visibility -->
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