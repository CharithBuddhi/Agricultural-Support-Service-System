<?php
session_start();
    date_default_timezone_set('Asia/Colombo');

    require('db_connect.php');

    // update froget password 
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

                    $hash_password = password_hash($confirm_password, PASSWORD_DEFAULT);
        
                    if($user_type == 'customer'){
                        $sql = "UPDATE `customer` SET `password`='$hash_password' WHERE customer_email = '$email'";
                        
                    }else if($user_type == 'farmer'){
                        $sql = "UPDATE `farmer` SET `password`='$hash_password' WHERE farmer_email = '$email'";
                        
                    }else if($user_type == 'supplier'){
                        $sql = "UPDATE `supplier` SET `password`='$hash_password' WHERE supplier_email = '$email'";
        
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

    if(isset($_POST['product_update'])){

        $Product_id_update = $_POST['Product_id_update'];
        $Product_name_update = trim($_POST['Product_name_update']);

        $Origin_update = trim($_POST['Origin_update']);

        // catch value based on product origin
        if($Origin_update  == "fertilizer"){
            $Category_update = trim($_POST['Category_fertilizer_update']);
            
        }else if($Origin_update  == "chemical"){
            $Category_update = trim($_POST['Category_chemical_update']);
        }

        
        $type_update = trim($_POST['type_update']);
        $sls_number_update = trim($_POST['sls_number_update']);
        $iso_number_update = trim($_POST['iso_number_update']); 

        if(isset($_FILES['Product_image_update'])){
            $Product_image_update = $_FILES['Product_image_update']['name'];
            $image_temp_name = $_FILES['Product_image_update']['tmp_name'];
            $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\end\\images\\fertilizer\\saveferti/$Product_image_update";     
        }

        $Description_update = trim($_POST['Description_update']);
        $product_price_update = trim($_POST['product_price_update']);

        $product_quantity_update = trim($_POST['product_quantity_update']);
        $measurement_update = trim($_POST['measurement_update']);
        $total_quantity_update = trim($_POST['total_quantity_update']);    
        $district_update = trim($_POST['district_update']);   
        $area_update = trim($_POST['area_update']);
        $address_update = trim($_POST['address_update']);
        
        $commission_update = $product_price_update * 0.02;

        if(!empty($Product_image_update)){

            $sql = "SELECT agro_image FROM `agrochemical` WHERE `agro_id` = '$Product_id_update'";
            $result = mysqli_query($conn, $sql);

            if($result->num_rows > 0){

                $row = $result->fetch_assoc();
    
                $filePath = 'images/fertilizer/saveferti/'.$row['agro_image'];
    
                // Delete the file from the server
                if(file_exists($filePath)){ 
    
                    unlink($filePath);

                    if(move_uploaded_file($image_temp_name,$image_destination)){

                        $sql = "UPDATE agrochemical SET agro_name = ? , 
                                                        agro_category = ? ,
                                                        fertilizer_category = ?,
                                                        fertilizer_type = ?,
                                                        iso_id = ?, 
                                                        sls_id = ?, 
                                                        agro_image = ?, 
                                                        agro_description = ?,
                                                        agro_price = ?, 
                                                        commission = ?,
                                                        agro_quantity = ?, 
                                                        total_quantity = ?, 
                                                        meassure = ?, 
                                                        agro_district = ?, 
                                                        agro_area = ?, 
                                                        agro_location = ? WHERE agro_id = ?";

                        $stmt = $conn->prepare($sql);
            
                        if ($stmt === false) {
                            die("Error preparing statement: " . $conn->error);
                        }
            
                        // Bind parameters (types: 's' for string, 'i' for integer)
                        $stmt->bind_param("ssssssssddddssssi", $Product_name_update, 
                                                                    $Origin_update, 
                                                                    $Category_update, 
                                                                    $type_update, 
                                                                    $iso_number_update, 
                                                                    $sls_number_update,
                                                                    $Product_image_update,
                                                                    $Description_update,
                                                                    $product_price_update,
                                                                    $commission_update,
                                                                    $product_quantity_update,
                                                                    $total_quantity_update,
                                                                    $measurement_update,
                                                                    $district_update,
                                                                    $area_update,
                                                                    $address_update,
                                                                    $Product_id_update
                                                                );
            
                        // Execute the statement
                        if ($stmt->execute()) {
                            $_SESSION['product_manage'] = "Product details update successfully";
                            header("location:product_manage.php");
                            exit();
                        } else {
                            $_SESSION['product_manage'] = "Product details update failed!";
                            header("location:product_manage.php");
                            exit();
                        }


                    }else{
                        $_SESSION['product_manage'] = "Please select a image to upload for update!";
                        header("Location: product_manage.php");
                        exit();
                    }

                }else{
                    $_SESSION['product_manage'] = "Product image already missing!";
                    header("Location: product_manage.php");
                    exit();
                }

            }else{
                $_SESSION['product_manage'] = "Product image are not found!";
                header("location: product_manage.php");
                exit();
            }

        }else{
            
            $sql = "UPDATE agrochemical SET agro_name = ? , 
                        agro_category = ? ,
                        fertilizer_category = ?,
                        fertilizer_type = ?,
                        iso_id = ?, 
                        sls_id = ?, 
                        agro_description = ?,
                        agro_price = ?,
                        commission = ?,
                        agro_quantity = ?, 
                        total_quantity = ?, 
                        meassure = ?, 
                        agro_district = ?, 
                        agro_area = ?, 
                        agro_location = ? WHERE agro_id = ?";

            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
            }

            // Bind parameters (types: 's' for string, 'i' for integer)
            $stmt->bind_param("sssssssddddssssi", $Product_name_update, 
                $Origin_update, 
                $Category_update, 
                $type_update, 
                $iso_number_update, 
                $sls_number_update,
                $Description_update,
                $product_price_update,
                $commission_update,
                $product_quantity_update,
                $total_quantity_update,
                $measurement_update,
                $district_update,
                $area_update,
                $address_update,
                $Product_id_update);

            // Execute the statement
            if ($stmt->execute()) {
                $_SESSION['product_manage'] = "Product details update successfully";
                header('location:product_manage.php');
                exit();
            } else {
                $_SESSION['product_manage'] = "Product details update failed!";
                header('location:product_manage.php');
                exit();
            }
        }

    }

    if(isset($_POST['vegetable_update'])){

        $update_vegfruitle_id = $_POST['update_vegfruitle_id'];
        $update_product_category = trim($_POST['update_product_category']);
        $update_product_name = trim($_POST['update_product_name']);
        $update_product_variety = trim($_POST['update_product_variety']);
        
        $update_product_price = trim($_POST['update_product_price']);
        $update_total_quantity = trim($_POST['update_total_quantity']);
    
        $update_district = trim($_POST['update_district']);
        $update_area = trim($_POST['update_area']);
        $update_address = trim($_POST['update_address']);
    
        
        if(isset($_FILES['update_product_image'])){
            $update_product_image = $_FILES['update_product_image']['name'];
            $image_temp_name = $_FILES['update_product_image']['tmp_name'];
            $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\end\\images\\vegetable/$update_product_image";
        }

        if(!empty($update_product_image)){

            $sql = "SELECT vegfruit_image FROM `vegetablefruit` WHERE `vegfruitle_id` = '$update_vegfruitle_id'";
            $result = mysqli_query($conn, $sql);

            if($result->num_rows > 0){

                $row = $result->fetch_assoc();
    
                $filePath = 'images/vegetable/'.$row['vegfruit_image'];
    
                // Delete the file from the server
                if(file_exists($filePath)){ 
    
                    unlink($filePath);

                    if(move_uploaded_file($image_temp_name,$image_destination)){

                        $sql = "UPDATE vegetablefruit SET vegetable_category = ? , 
                                                        vegetable_name = ? ,
                                                        vegfruitle_verity = ?,
                                                        vegfruit_distric = ?,
                                                        vegfruit_area = ?, 
                                                        vegfruit_location = ?, 
                                                        vegfruit_image = ?, 
                                                        vegfruit_price = ?,
                                                        vegfruit_total = ? WHERE vegfruitle_id = ?";

                        $stmt = $conn->prepare($sql);
            
                        if ($stmt === false) {
                            die("Error preparing statement: " . $conn->error);
                        }
            
                        // Bind parameters (types: 's' for string, 'i' for integer)
                        $stmt->bind_param("sssssssddi", $update_product_category, 
                                                                    $update_product_name, 
                                                                    $update_product_variety, 
                                                                    $update_district, 
                                                                    $update_area, 
                                                                    $update_address,
                                                                    $update_product_image,
                                                                    $update_product_price,
                                                                    $update_total_quantity,
                                                                    $update_vegfruitle_id
                                                                );
            
                        // Execute the statement
                        if ($stmt->execute()) {
                            $_SESSION['vegetable_manage'] = "Product details update successfully";
                            header("location:vegetable_manage.php");
                            exit();
                        } else {
                            $_SESSION['vegetable_manage'] = "Product details update failed!";
                            header("location:vegetable_manage.php");
                            exit();
                        }


                    }else{
                        $_SESSION['vegetable_manage'] = "Please select a image to upload for update!";
                        header("Location: vegetable_manage.php");
                        exit();
                    }

                }else{
                    $_SESSION['vegetable_manage'] = "Product image already missing!";
                    header("Location: vegetable_manage.php");
                    exit();
                }

            }else{
                $_SESSION['vegetable_manage'] = "Product image are not found!";
                header("location: vegetable_manage.php");
                exit();
            }

        }else{
            
            $sql = "UPDATE vegetablefruit SET vegetable_category = ? , 
            vegetable_name = ? ,
            vegfruitle_verity = ?,
            vegfruit_distric = ?,
            vegfruit_area = ?, 
            vegfruit_location = ?,  
            vegfruit_price = ?,
            vegfruit_total = ? WHERE vegfruitle_id = ?";

            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
            }

            // Bind parameters (types: 's' for string, 'i' for integer)
            $stmt->bind_param("ssssssddi", $update_product_category, 
                $update_product_name, 
                $update_product_variety, 
                $update_district, 
                $update_area, 
                $update_address,
                $update_product_price,
                $update_total_quantity,
                $update_vegfruitle_id
            );

            // Execute the statement
            if ($stmt->execute()) {
                $_SESSION['vegetable_manage'] = "Product details update successfully";
                header('location:vegetable_manage.php');
                exit();
            } else {
                $_SESSION['vegetable_manage'] = "Product details update failed!";
                header('location:vegetable_manage.php');
                exit();
            }
        }

    }


    
?>