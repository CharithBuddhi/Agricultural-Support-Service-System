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

    if(isset($_POST['payment_detail_update'])){ 

        $voucher_image = $_FILES['voucher_image']['name'];
        
        if(isset($voucher_image) && !empty(trim($voucher_image))){

            $voucher_Reg_ID = $_POST['voucher_Reg_ID'];
            $voucher_RP_ID = $_POST['voucher_RP_ID'];
            $voucher_product_name = $_POST['voucher_product_name'];
            $voucher_product_id = $_POST['voucher_product_id'];
            $voucher_amount_due = $_POST['voucher_amount_due'];
            $voucher_total_amount = $_POST['voucher_total_amount'];
            $voucher_provider_name = $_POST['voucher_provider_name'];
            $voucher_customer_name = $_POST['voucher_customer_name'];          

            $date_time = time();
            
            $image_temp_name = $_FILES['voucher_image']['tmp_name'];

            $voucher_image = $date_time . "_" . $_FILES['voucher_image']['name'];
            
            $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\admin\\images\\payment\\" . $voucher_image;   

            if(move_uploaded_file($image_temp_name,$image_destination)){

                $INSERT = "INSERT INTO voucher (rp_id, product_id, provider_name, product_name, customer_id, customer_name, amount_due, amount_total, voucher) VALUES (?,?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("iissisdds", $voucher_RP_ID, $voucher_product_id, $voucher_provider_name, $voucher_product_name,  $voucher_Reg_ID, $voucher_customer_name, $voucher_amount_due, $voucher_total_amount, $voucher_image);
                $_SESSION['payment_slip'] = "Your payment details Upload successfully. Check here after few hours!";
                $stmt->execute();
                $stmt->close();
                $UPDATE = "UPDATE `transaction` SET `payment_status` = 'Process' WHERE `Reference_id` = '$voucher_RP_ID'";
                $stmt1 = $conn->prepare($UPDATE);
                $stmt1->execute();
                $stmt1->close();
                $conn->close();
                header("Location: payment_dashboard.php");
                exit();
                
            }else{
                echo "Failed to upload file. Error: " . $_FILES['voucher_image']['error'];
                $_SESSION['payment_slip'] = "Your upload has been failed!";
                header("Location: payment_dashboard.php");
                exit();
            }

            
            
        }else{
            $_SESSION['payment_slip'] = 'please upload payment slip';
            header("Location: {$_SERVER["HTTP_REFERER"]}");
        }
    }


?>