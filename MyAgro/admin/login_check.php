<?php
session_start();
include('db_conn.php');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];


    if(empty(trim($username)) || empty(trim($password))){
        $_SESSION['login_status'] = "Please fill the all input field";
        header("Location: index.php");
        exit();

    }else{

        $sql = "SELECT * FROM staff WHERE staff_userName = '$username'";
        $query_run = mysqli_query($conn, $sql);

        if(mysqli_num_rows($query_run) >  0){

            $row = mysqli_fetch_assoc($query_run);
            
            $hash_password = $row['staff_password'];
            if(!password_verify($password, $hash_password)){
                $_SESSION['login_message'] = "Invalid username or password";
                header("Location: index.php");
                exit();
            }else{
                $user_type = $row['staff_type'];
                $staff_id = $row['staff_id'];
            }
            
            if($user_type == 'admin'){
                $_SESSION[$row['staff_id']];
                $_SESSION['login_admin_id'][$staff_id] = $row['staff_userName'];
                $_SESSION['login_admin_user'] = $row['staff_userName'];
                $_SESSION['login_admin_type'] = $user_type;
                $_SESSION['admin_home_message'] = "Login successfull";
                header("Location: admin.php");
                exit();

            }else if($user_type == 'assistant'){
                $_SESSION['login_staff_id'][$staff_id] = $row['staff_userName'];
                $_SESSION['login_staff_user'] = $row['staff_userName'];
                $_SESSION['login_staff_type'] = $user_type;
                $_SESSION['staff_home_message'] = "Login successfull";
                header("Location: staff.php");
                exit();

            }else{
                $_SESSION['login_status'] = "Invalid user";
                header("Location: index.php");
                exit();
            }
    
        }else{
            $_SESSION['login_status'] = 'Invalid username or password';
            header("Location: index.php");
            exit();
        }

    }
    
}else{
    $conn->close();
    header("Location: index.php");
    exit();
}
?>