<?php
session_start();
    date_default_timezone_set('Asia/Colombo');

    require('db_connect.php');

    // staff_password_update_btn in profile
    if(isset($_POST['update_password'])){

        if(isset($_POST['email']) && isset($_POST['new_password']) && isset($_POST['confirm_password']) && isset($_POST['usertype'])){

            unset($_SESSION['froget_email_send']);

            $email = $_POST['email'];
            $new_password= $_POST['new_password'];
            $confirm_password= $_POST['confirm_password'];
            $user_type = $_POST['usertype'];

            if($user_type == ''){
                $_SESSION['login_message'] = 'please select the user type';
                header("Location: {$_SERVER["HTTP_REFERER"]}");
                exit(0);
            }

            if($user_type == 'customer'){
                $check = "SELECT `customer_email` FROM `customer` WHERE customer_email = '$email'";
            }else if($user_type == 'farmer'){
                $check = "SELECT `farmer_email` FROM `farmer` WHERE farmer_email = '$email'";
            }else if($user_type == 'supplier'){
                $check = "SELECT `supplier_email` FROM `supplier` WHERE supplier_email = '$email'";
            }
            $result = mysqli_query($conn, $check);
            $row = mysqli_num_rows($result);

            if($row == 0){
                $_SESSION['login_message'] = 'User not found';
                header("Location: {$_SERVER["HTTP_REFERER"]}");
                exit(0);
            }else{

                if($new_password!=$confirm_password){
                    $_SESSION['login_message'] = 'New password and confirm password not matched';
                    header("Location: {$_SERVER["HTTP_REFERER"]}");
                    exit(0);
        
                }else if($new_password==$confirm_password){

                    
        
                    if($user_type == 'customer'){
                        $sql = "UPDATE `customer` SET `password`='$confirm_password' WHERE customer_email = '$email'";
                        
                    }else if($user_type == 'farmer'){
                        $sql = "UPDATE `farmer` SET `password`='$confirm_password' WHERE farmer_email = '$email'";
                        
                    }else if($user_type == 'supplier'){
                        $sql = "UPDATE `supplier` SET `password`='$confirm_password' WHERE supplier_email = '$email'";
        
                    }
                    $result1 = mysqli_query($conn, $sql);
                    if($result1){
                        $_SESSION['login_message'] = 'Your password update successfully';
                        header("Location: login.php");
                        exit(0);
                    }
                    else{
                        $_SESSION['login_message'] = 'Your password update failed';
                        header("Location: login.php");
                        exit(0);
                    }
                    
                }
            }

        }else{
            $_SESSION['login_message'] = 'All fields are required';
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }   
    }