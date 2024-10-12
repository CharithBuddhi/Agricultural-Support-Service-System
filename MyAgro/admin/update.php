<?php
session_start();

    $id = $_SESSION['id'];

    require('db_conn.php');

    // email update in profile
    if(isset($_POST['profile_update_btn'])){

        $staff_email= $_POST['email'];
        $check = "SELECT  `staff_email` FROM `staff` WHERE staff_id = '$id'";
        $result = mysqli_query($conn, $check);
        $row = mysqli_fetch_assoc($result);
        $email = $row['staff_email'];

        if($staff_email==$email){
            $_SESSION['profile_status'] = 'You are not change your email address';
            header("Location: profile.php");
            exit(0);
        }else{
            $sql = "UPDATE `staff` SET `staff_email`='$staff_email' WHERE staff_id = '$id'";
            $result1 = mysqli_query($conn, $sql);
        
            if($result1){
                $_SESSION['profile_status'] = 'Your email address update successfully';
                header("Location: profile.php");
                exit(0);
            }
            else{
                $_SESSION['profile_status'] = 'Email address not update';
                header("Location: profile.php");
                exit(0);
            }
        }

    }

    // password update in profile
    if(isset($_POST['password_update_btn'])){

        $id = $_SESSION['id'];
        $old_password= $_POST['old_password'];
        $new_password= $_POST['new_password'];
        $confirm_password= $_POST['confirm_password'];

        $check = "SELECT  `staff_password` FROM `staff` WHERE staff_id = '$id'";
        $result = mysqli_query($conn, $check);
        $row = mysqli_fetch_assoc($result);
        $password = $row['staff_password'];

        if($old_password==$password){

            if($old_password==$new_password){
                $_SESSION['profile_status'] = 'You are not change your password';
                header("Location: profile.php");
                exit(0);

            }else if($new_password!=$confirm_password){
                $_SESSION['profile_status'] = 'New password and confirm password not matched';
                header("Location: profile.php");
                exit(0);

            }else if($new_password==$confirm_password){
                $sql = "UPDATE `staff` SET `staff_password`='$confirm_password' WHERE staff_id = '$id'";
                $result1 = mysqli_query($conn, $sql);
                if($result1){
                    $_SESSION['profile_status'] = 'Your password update successfully';
                    header("Location: profile.php");
                    exit(0);
                }
                else{
                    $_SESSION['profile_status'] = 'Email address not update';
                    header("Location: profile.php");
                    exit(0);
                }
            }

        }else{
            $_SESSION['profile_status'] = 'Your Old password wrong';
            header("Location: profile.php");
            exit(0);
        }

    }

?>