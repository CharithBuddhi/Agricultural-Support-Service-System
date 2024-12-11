<?php
session_start();
    date_default_timezone_set('Asia/Colombo');

    require('db_conn.php');

    // admin_profile_update_btn in profile
    if(isset($_POST['admin_profile_update_btn'])){

        $id = $_POST['admin_id'];
        $admin_email = $_POST['email'];
        $admin_name = $_POST['name'];

        $check = "SELECT  staff_name, staff_email FROM `staff` WHERE staff_id = '$id'";
        $result = mysqli_query($conn, $check);
        $row = mysqli_fetch_assoc($result);
        $staff_admin_name = $row['staff_name'];
        $staff_admin_email = $row['staff_email'];

        if($staff_admin_email==$admin_email && $staff_admin_name==$admin_name){
            $_SESSION['admin_profile_status'] = 'You are not change your email or name';
            header("Location: admin_profile.php");
            exit(0);
        }

        if($staff_admin_email!=$admin_email || $staff_admin_name!=$admin_name){

            $sql = "UPDATE `staff` SET `staff_name`='$admin_name', `staff_email`='$admin_email', update_date = NOW() WHERE staff_id = '$id'";
            $result1 = mysqli_query($conn, $sql);
            if($result1){
                $_SESSION['admin_profile_status'] = 'Your details update successfully';
                header("Location: admin_profile.php");
                exit(0);
            }
            else{
                $_SESSION['admin_profile_status'] = 'Your details can not update';
                header("Location: admin_profile.php");
                exit(0);
            }
        } 
    }

    // staff_profile_update_btn in profile
    if (isset($_POST['staff_profile_update_btn'])) {
        $staff_id = $_POST['user_id'];
        $staff_email = $_POST['email'];

        $stmt = $conn->prepare("SELECT staff_email FROM staff WHERE staff_id = ?");
        $stmt->bind_param("i", $staff_id);  // 'i' for integer type
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $db_staff_email = $row['staff_email'];
    
            if ($db_staff_email == $staff_email) {
                $_SESSION['profile_status'] = 'You did not change your email';
                header("Location: profile.php");
                exit(0);
            } else {
                $stmt = $conn->prepare("UPDATE staff SET staff_email = ?, update_date = NOW() WHERE staff_id = ?");
                $stmt->bind_param("si", $staff_email, $staff_id);  // 's' for string, 'i' for integer
                $result1 = $stmt->execute();
    
                if ($result1) {
                    $_SESSION['profile_status'] = 'Your profile has been updated successfully';
                    header("Location: profile.php");
                    exit(0);
                } else {
                    $_SESSION['profile_status'] = 'Your profile details could not be updated';
                    header("Location: profile.php");
                    exit(0);
                }
            }
        } else {
            $_SESSION['profile_status'] = 'Failed to retrieve current profile information';
            // header("Location: profile.php");
            // exit(0);
        }
    }

    // admin_password_update_btn in profile
    if(isset($_POST['admin_password_update_btn'])){

        $id = $_POST['admin_id'];
        $admin_old_password= $_POST['old_password'];
        $admin_new_password= $_POST['new_password'];
        $admin_confirm_password= $_POST['confirm_password'];

        $check = "SELECT  `staff_password` FROM `staff` WHERE staff_id = '$id'";
        $result = mysqli_query($conn, $check);
        $row = mysqli_fetch_assoc($result);
        $password = $row['staff_password'];

        if($admin_old_password==$password){

            if($admin_old_password==$admin_new_password){
                $_SESSION['admin_profile_status'] = 'You are not change your password';
                header("Location: admin_profile.php");
                exit(0);

            }else if($admin_new_password!=$admin_confirm_password){
                $_SESSION['admin_profile_status'] = 'New password and confirm password not matched';
                header("Location: admin_profile.php");
                exit(0);

            }else if($admin_new_password==$admin_confirm_password){
                $sql = "UPDATE `staff` SET `staff_password`='$admin_confirm_password', update_date = NOW() WHERE staff_id = '$id'";
                $result1 = mysqli_query($conn, $sql);
                if($result1){
                    $_SESSION['admin_profile_status'] = 'Your password update successfully';
                    header("Location: admin_profile.php");
                    exit(0);
                }
                else{
                    $_SESSION['admin_profile_status'] = 'Your password can not update';
                    header("Location: admin_profile.php");
                    exit(0);
                }
            }

        }else{
            $_SESSION['admin_profile_status'] = 'Your Old password wrong';
            header("Location: admin_profile.php");
            exit(0);
        }

    }

    // staff_password_update_btn in profile
    if(isset($_POST['staff_password_update_btn'])){

        $id = $_POST['user_id'];
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
                $sql = "UPDATE `staff` SET `staff_password`='$confirm_password', update_date = NOW() WHERE staff_id = '$id'";
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

    // harvest month update
    if(isset($_POST['harvest_month_update'])){

        $month_id = $_POST['month_id'];
        $month_crop = trim($_POST['month_crop']);
        $month_variety = trim($_POST['month_variety']);
        $month_yala_start = trim($_POST['month_yala_start']);
        $month_yala_end = trim($_POST['month_yala_end']);
        $month_maha_start = trim($_POST['month_maha_start']);
        $month_maha_end = trim($_POST['month_maha_end']); 
    
        if($month_yala_start==$month_yala_end){
            $_SESSION['harvest_msg'] = "Can't Yala Start Data and End Date Same";
            header('location:price.php');
            exit();
        }else if($month_maha_start==$month_maha_end){
            $_SESSION['harvest_msg'] = "Can't Maha Start Data and End Date Same";
            header('location:price.php');
            exit();
        }else if($month_yala_start > $month_yala_end || $month_maha_start > $month_maha_end){
            $_SESSION['harvest_msg'] = "Start Date should be less than End Date";
            header('location:price.php');
            exit();
        }else{

            $run = "SELECT * FROM `harvest` WHERE harvest_id = '$month_id'";
            $result = mysqli_query($conn,$run);
            $row = mysqli_num_rows($result);

            if($row > 0){

                $run1 = "SELECT * FROM `harvest` WHERE `crop_name` = '$month_crop' AND `crop_variety` = '$month_variety'";
                $result1 = mysqli_query($conn,$run1);
                $row = mysqli_num_rows($result1);
                $db_varity_id = mysqli_fetch_assoc($result1)['harvest_id'];

                if($db_varity_id != $month_id){
                    $_SESSION['harvest_msg'] = "This Harvest varitey already added";
                    header('location:price.php');
                    exit();

                }else{
                    $sql= "UPDATE `harvest` SET `crop_name`='$month_crop',`crop_variety`='$month_variety',`yala_start`='$month_yala_start',`yala_end`='$month_yala_end',`maha_start`='$month_maha_start',`maha_end`='$month_maha_end' WHERE `harvest_id` = '$month_id'";
                    $result = mysqli_query($conn,$sql);
            
                    if($result){
                        $_SESSION['harvest_msg'] = "Harvest month updated successfully";
                        header('location:price.php');
                        exit();
                    }else{
                        $_SESSION['harvest_msg'] = "This Harvest month can not updated";
                        header('location:price.php');
                        exit();
                    }
                }
               
            }else{

                $_SESSION['harvest_msg'] = "This Harvest month detail can not founded";
                header('location:price.php');
                exit();
            }

        }
    

    
    }

    // varities details select for update and send it module
    if (isset($_POST['verity_id'])) {
        $verity_id = $_POST['verity_id'];

        $sql = "SELECT * FROM `verity` WHERE verity_id ='$verity_id'";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            header('Content-Type: application/json');
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    }

    // varities details update here
    if(isset($_POST['verities_update'])){

        $verity_id = $_POST['verity_id'];
        $Product_name = trim($_POST['Product_name']);
        $Verities_name = trim($_POST['Verities_name']);
        $Origin = trim($_POST['Origin']);
        $Days_Maturity = trim($_POST['Days_Maturity']);
        $Category = trim($_POST['Category']);
        if(isset($_FILES['Verities_image'])){
            $Verities_image = $_FILES['Verities_image']['name'];
            $image_temp_name = $_FILES['Verities_image']['tmp_name'];
            $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\admin\\images\\verity/$Verities_image";     
        }
        $Description = trim($_POST['Description']); 
    
        $Light = trim($_POST['Light']);
        $Water = trim($_POST['Water']);
        $Nutrient = trim($_POST['Nutrient']);
        $Soil = trim($_POST['Soil']);
        $distance = trim($_POST['distance']);
        $depth = trim($_POST['depth']);
        $spacing = trim($_POST['spacing']);
    
        $Harvest_message = trim($_POST['Harvest_message']);
    
        $Companion = trim($_POST['Companion']);
        $Antagonistic = trim($_POST['Antagonistic']);
        $Diseases = trim($_POST['Diseases']);
        $Pests = trim($_POST['Pests']);
    

        if(!empty($Verities_image)){

            $sql = "SELECT Verities_image FROM `verity` WHERE `verity_id` = '$verity_id'";
            $result = mysqli_query($conn, $sql);

            if($result->num_rows > 0){

                $row = $result->fetch_assoc();
    
                $filePath = 'images/verity/' . $row['Verities_image'];
    
                // Delete the file from the server
                if(file_exists($filePath)){ 
    
                    unlink($filePath);

                    if(move_uploaded_file($image_temp_name,$image_destination)){

                        // escape for " ' " this mark is used to prevent sql injection
                        // Escape each input variable to prevent SQL injection and handle special characters
                        $Product_name = mysqli_real_escape_string($conn, $Product_name);
                        $Verities_name = mysqli_real_escape_string($conn, $Verities_name);
                        $Days_Maturity = mysqli_real_escape_string($conn, $Days_Maturity);
                        $Verities_image = mysqli_real_escape_string($conn, $Verities_image);
                        $Description = mysqli_real_escape_string($conn, $Description);
                        $Light = mysqli_real_escape_string($conn, $Light);
                        $Water = mysqli_real_escape_string($conn, $Water);
                        $Nutrient = mysqli_real_escape_string($conn, $Nutrient);
                        $Soil = mysqli_real_escape_string($conn, $Soil);
                        $distance = mysqli_real_escape_string($conn, $distance);
                        $depth = mysqli_real_escape_string($conn, $depth);
                        $spacing = mysqli_real_escape_string($conn, $spacing);
                        $Harvest_message = mysqli_real_escape_string($conn, $Harvest_message);
                        $Companion = mysqli_real_escape_string($conn, $Companion);
                        $Antagonistic = mysqli_real_escape_string($conn, $Antagonistic);
                        $Diseases = mysqli_real_escape_string($conn, $Diseases);
                        $Pests = mysqli_real_escape_string($conn, $Pests);
                        $Origin = mysqli_real_escape_string($conn, $Origin);
                        $id = mysqli_real_escape_string($conn, $id);

                        $sql= "UPDATE `verity` SET 
                        `product_category`='$Category',
                        `product_name`='$Product_name',
                        `verity_name`='$Verities_name',
                        `Days_Maturity`='$Days_Maturity',
                        `Verities_image`='$Verities_image',
                        `Description`='$Description',
                        `Light`='$Light',
                        `Water`='$Water',
                        `Nutrient`='$Nutrient',
                        `Soil`='$Soil',
                        `distance`='$distance',
                        `depth`='$depth',
                        `spacing`='$spacing',
                        `Harvest_message`='$Harvest_message',
                        `Companion`='$Companion',
                        `Antagonistic`='$Antagonistic',
                        `Diseases`='$Diseases',
                        `Pests`='$Pests',
                        `Origin`='$Origin',
                        `reponsible`='$id' WHERE  `verity_id`='$verity_id' ";
                        
                        $result = mysqli_query($conn,$sql);

                        if($result){
                            $_SESSION['verity_status'] = "Verities details update successfully";
                            header('location:variety.php');
                            exit();
                        }else{
                            $_SESSION['verity_status'] = "Verities details update Failed!,Try Again";
                            header('location:variety.php');
                            exit();
                        }

                    }else{
                        $_SESSION['verity_status'] = "Please select a image to upload for update!";
                        header("Location: variety.php");
                        exit();
                    }

                }else{
                    $_SESSION['verity_status'] = "Variety image already missing!";
                    header("Location: variety.php");
                    exit();
                }

            }else{
                $_SESSION['verity_status'] = "Variety image are not found!";
                header('location: variety.php');
                exit();
            }

        }else{
            // escape for " ' " this mark is used to prevent sql injection
            // Escape each input variable to prevent SQL injection and handle special characters
            $Product_name = mysqli_real_escape_string($conn, $Product_name);
            $Verities_name = mysqli_real_escape_string($conn, $Verities_name);
            $Days_Maturity = mysqli_real_escape_string($conn, $Days_Maturity);
            $Description = mysqli_real_escape_string($conn, $Description);
            $Light = mysqli_real_escape_string($conn, $Light);
            $Water = mysqli_real_escape_string($conn, $Water);
            $Nutrient = mysqli_real_escape_string($conn, $Nutrient);
            $Soil = mysqli_real_escape_string($conn, $Soil);
            $distance = mysqli_real_escape_string($conn, $distance);
            $depth = mysqli_real_escape_string($conn, $depth);
            $spacing = mysqli_real_escape_string($conn, $spacing);
            $Harvest_message = mysqli_real_escape_string($conn, $Harvest_message);
            $Companion = mysqli_real_escape_string($conn, $Companion);
            $Antagonistic = mysqli_real_escape_string($conn, $Antagonistic);
            $Diseases = mysqli_real_escape_string($conn, $Diseases);
            $Pests = mysqli_real_escape_string($conn, $Pests);
            $Origin = mysqli_real_escape_string($conn, $Origin);
            $id = mysqli_real_escape_string($conn, $id);

            $sql= "UPDATE `verity` SET 
            `product_category`='$Category',
            `product_name`='$Product_name',
            `verity_name`='$Verities_name',
            `Days_Maturity`='$Days_Maturity',
            `Description`='$Description',
            `Light`='$Light',
            `Water`='$Water',
            `Nutrient`='$Nutrient',
            `Soil`='$Soil',
            `distance`='$distance',
            `depth`='$depth',
            `spacing`='$spacing',
            `Harvest_message`='$Harvest_message',
            `Companion`='$Companion',
            `Antagonistic`='$Antagonistic',
            `Diseases`='$Diseases',
            `Pests`='$Pests',
            `Origin`='$Origin',
            `reponsible`='$id' WHERE `verity_id`='$verity_id' ";
            
            $result = mysqli_query($conn,$sql);

            if($result){
                $_SESSION['verity_status'] = "Verities details update successfully";
                header('location:variety.php');
                exit();
            }else{
                $_SESSION['verity_status'] = "Verities details update Failed!,Try Again";
                header('location:variety.php');
                exit();
            }
        }

    }

    // nutrition details update here
    if(isset($_POST['update_nutrition'])){

        $update_item_id = $_POST['update_item_id'];
        $update_item_name = ucfirst(trim($_POST['update_Item_name']));
        $update_Category = ucfirst(trim($_POST['update_Category']));
        $update_Quantity = ucfirst(trim($_POST['update_Quantity']));
        $update_Nutrient1 = ucfirst(trim($_POST['update_Nutrient1']));
        $update_Nutrient2 = ucfirst(trim($_POST['update_Nutrient2']));
        $update_Nutrient3 = ucfirst(trim($_POST['update_Nutrient3']));
        $update_Nutrient4 = ucfirst(trim($_POST['update_Nutrient4']));
        $update_Nutrient5 = ucfirst(trim($_POST['update_Nutrient5']));
        $update_Nutrient6 = ucfirst(trim($_POST['update_Nutrient6']));

        $check = "SELECT `item` FROM `nutrition` WHERE `nutrient_id` = '$update_item_id'";
        $result = mysqli_query($conn, $check);
    
        // Count the number of rows with the matching 
        $rowCount = mysqli_num_rows($result);
        
        if($rowCount == 1) {

            $id = $_SESSION['login_staff_user'];
    
            $Item_name = mysqli_real_escape_string($conn, $update_item_name);
            $Category = mysqli_real_escape_string($conn, $update_Category);
            $Quantity = mysqli_real_escape_string($conn, $update_Quantity);
            $Nutrient1 = mysqli_real_escape_string($conn, $update_Nutrient1);
            $Nutrient2 = mysqli_real_escape_string($conn, $update_Nutrient2);
            $Nutrient3 = mysqli_real_escape_string($conn, $update_Nutrient3);
            $Nutrient4 = mysqli_real_escape_string($conn, $update_Nutrient4);
            $Nutrient5 = mysqli_real_escape_string($conn, $update_Nutrient5);
            $Nutrient6 = mysqli_real_escape_string($conn, $update_Nutrient6);

            $sql = "UPDATE `nutrition` SET `item`='$Item_name',`item_category`='$Category',`nutrient_amont`='$Quantity',
            `nutrient_valu1`='$Nutrient1',`nutrient_valu2`='$Nutrient2',`nutrient_valu3`='$Nutrient3',`nutrient_valu4`='$Nutrient4',
            `nutrient_valu5`='$Nutrient5',`nutrient_valu6`='$Nutrient6',`response`='$id', update_time = NOW() WHERE nutrient_id='$update_item_id'";
            $updateResult = mysqli_query($conn, $sql);

            if($updateResult) {

                $_SESSION['verity_status'] = "Nurition details update successfully";
                header('location:variety.php');
                exit();

            } else {

                $_SESSION['verity_status'] = "Nurition details update failed!,Try Again";
                header('location:variety.php');
                exit();
            }
            
        }else{

            $_SESSION['verity_status'] = "This nurition details are not exist";
            header('location:variety.php');
            exit();
        }

    }

    // password reset in staff members
    if(isset($_POST['froget_password_update'])){


        $username = $_POST['username'];
    

        $check = "SELECT `staff_userName` FROM `staff` WHERE `staff_userName` = '$username'";
        $result = mysqli_query($conn, $check);
    
        // Count the number of rows with the matching username
        $rowCount = mysqli_num_rows($result);
    
        // If no user is found, show error message
        if($rowCount == 0) {
            $_SESSION['staff_reg_msg'] = 'This user is not registered in the system.';
            header("Location: staff_info.php");
            exit(0);
        }
    
        // If more than one user with the same username is found
        if($rowCount > 1) {
            $_SESSION['staff_reg_msg'] = 'This username is used by more than one user.';
            header("Location: staff_info.php");
            exit(0);
        }
    
        // If exactly one user is found
        if($rowCount == 1) {
            $items = mysqli_fetch_assoc($result);
            $user = $items['staff_userName'];
    
            if(!empty($user)) {
                // Update password
                $sql = "UPDATE `staff` SET `staff_password` = '00000', update_date = NOW() WHERE `staff_userName` = '$user'";
                $updateResult = mysqli_query($conn, $sql);
    
                if($updateResult) {
                    // If password reset is successful
                    $_SESSION['staff_reg_msg'] = 'Password reset successfully.';
                    header("Location: staff_info.php");
                    exit(0);
                } else {
                    // If password reset fails
                    $_SESSION['staff_reg_msg'] = 'User password could not be reset.';
                    header("Location: staff_info.php");
                    exit(0);
                }
            }
        }
    }

    // staff memeber details are update
    if(isset($_POST['staff_detail_update'])){


        $update_staff_username = $_POST['update_staff_username'];
        $update_staff_name = $_POST['update_staff_name'];
        $update_staff_role = $_POST['update_staff_role'];
    

        $check = "SELECT staff_userName, staff_name, staff_type FROM `staff` WHERE `staff_userName` = '$update_staff_username'";
        $result = mysqli_query($conn, $check);
    
        // Count the number of rows with the matching username
        $rowCount = mysqli_num_rows($result);
    
        // If no user is found, show error message
        if($rowCount == 0) {
            $_SESSION['staff_reg_msg'] = 'This user details are missing from the system.';
            header("Location: staff_info.php");
            exit(0);
        }
        $row = mysqli_fetch_assoc($result);
        $db_staff_username = $row['staff_userName'];
        $db_staff_name = $row['staff_name'];
        $db_staff_role = $row['staff_type'];

        if($db_staff_name == $update_staff_name && $db_staff_role == $update_staff_role){
            $_SESSION['staff_reg_msg'] = 'You are not change your name or role';
            header("Location: staff_info.php");
            exit(0);
        }

        if($db_staff_name != $update_staff_name || $db_staff_role != $update_staff_role){

            $sql = "UPDATE `staff` SET `staff_name`='$update_staff_name', `staff_type`='$update_staff_role', update_date = NOW() WHERE `staff_userName` = '$update_staff_username'";
            $result1 = mysqli_query($conn, $sql);
            if($result1){
                $_SESSION['staff_reg_msg'] = 'staff memeber details update successfully';
                header("Location: staff_info.php");
                exit(0);
            }
            else{
                $_SESSION['staff_reg_msg'] = 'staff memeber details can not update';
                header("Location: staff_info.php");
                exit(0);
            }
        }


    }

    // customer status update for hold
    if(isset($_POST['customer_status_hold_btn'])){


        $customer_id = $_POST['customer_id'];
    
        $check = "SELECT customer_status FROM `customer` WHERE `customer_id` = '$customer_id'";
        $result = mysqli_query($conn, $check);
    
        // Count the number of rows with the matching username
        $rowCount = mysqli_num_rows($result);
    
        // If no user is found, show error message
        if($rowCount == 0) {
            echo 'This user details are missing from the system.';
            exit(0);
        }
        $row = mysqli_fetch_assoc($result);
        $db_customer_status = $row['customer_status'];

        if($db_customer_status == 1){
            echo'This user is already Hold.';
            exit(0);
        }
        $sql = "UPDATE `customer` SET `customer_status`= 1 WHERE customer_id = '$customer_id'";
        $result1 = mysqli_query($conn, $sql);
        if($result1){
            echo 'Customer account hold successfully.';
            exit(0);
        }
        else{
            echo "Customer account cannot be hold.";
            exit(0);
        }

    }

    // customer_status_active_btn
    if(isset($_POST['customer_status_active_btn'])){

        $customer_id = $_POST['customer_id'];
    
        $check = "SELECT customer_status FROM `customer` WHERE `customer_id` = '$customer_id'";
        $result = mysqli_query($conn, $check);
    
        // Count the number of rows with the matching username
        $rowCount = mysqli_num_rows($result);
    
        // If no user is found, show error message
        if($rowCount == 0) {
            echo 'This user details are missing from the system.';
            exit(0);
        }
        $row = mysqli_fetch_assoc($result);
        $db_customer_status = $row['customer_status'];

        if($db_customer_status == 0){
            echo'This user account is already Active.';
            exit(0);
        }
        $sql = "UPDATE `customer` SET `customer_status`= 0 WHERE customer_id = '$customer_id'";
        $result1 = mysqli_query($conn, $sql);
        if($result1){
            echo 'Customer account active successfully.';
            exit(0);
        }
        else{
            echo "Customer account cannot be active.";
            exit(0);
        }


    }

    // supplier_status_hold_btn
    if(isset($_POST['supplier_status_hold_btn'])){


        $supplier_id = $_POST['supplier_id'];
    
        $check = "SELECT supplier_status FROM `supplier` WHERE `supplier_id` = '$supplier_id'";
        $result = mysqli_query($conn, $check);
    
        // Count the number of rows with the matching username
        $rowCount = mysqli_num_rows($result);
    
        // If no user is found, show error message
        if($rowCount == 0) {
            echo 'This user details are missing from the system.';
            exit(0);
        }
        $row = mysqli_fetch_assoc($result);
        $db_supplier_status = $row['supplier_status'];

        if($db_supplier_status == 1){
            echo'This user is already Hold.';
            exit(0);
        }
        $sql = "UPDATE `supplier` SET `supplier_status`= 1 WHERE supplier_id = '$supplier_id'";
        $result1 = mysqli_query($conn, $sql);
        if($result1){
            echo 'Supplier account hold successfully.';
            exit(0);
        }
        else{
            echo "Supplier account cannot be hold.";
            exit(0);
        }

    }

    // supplier_status_active_btn
    if(isset($_POST['supplier_status_active_btn'])){

        $supplier_id = $_POST['supplier_id'];
    
        $check = "SELECT supplier_status FROM `supplier` WHERE `supplier_id` = '$supplier_id'";
        $result = mysqli_query($conn, $check);
    
        // Count the number of rows with the matching username
        $rowCount = mysqli_num_rows($result);
    
        // If no user is found, show error message
        if($rowCount == 0) {
            echo 'This user details are missing from the system.';
            exit(0);
        }
        $row = mysqli_fetch_assoc($result);
        $db_supplier_status = $row['supplier_status'];

        if($db_supplier_status == 0){
            echo'This user account is already Active.';
            exit(0);
        }
        $sql = "UPDATE `supplier` SET `supplier_status`= 0 WHERE supplier_id = '$supplier_id'";
        $result1 = mysqli_query($conn, $sql);
        if($result1){
            echo 'Supplier account active successfully.';
            exit(0);
        }
        else{
            echo "Supplier account cannot be active.";
            exit(0);
        }


    }

     // farmer_status_hold_btn
     if(isset($_POST['farmer_status_hold_btn'])){


        $farmer_id = $_POST['farmer_id'];
    
        $check = "SELECT farmer_status FROM `farmer` WHERE `farmer_id` = '$farmer_id'";
        $result = mysqli_query($conn, $check);
    
        // Count the number of rows with the matching username
        $rowCount = mysqli_num_rows($result);
    
        // If no user is found, show error message
        if($rowCount == 0) {
            echo 'This user details are missing from the system.';
            exit(0);
        }else{
            
            $row = mysqli_fetch_assoc($result);
            $db_farmer_status = $row['farmer_status'];
    
            if($db_farmer_status == 1){
                echo'This user is already Hold.';
                exit(0);
            }
            $sql = "UPDATE `farmer` SET `farmer_status`= 1 WHERE farmer_id = '$farmer_id'";
            $result1 = mysqli_query($conn, $sql);
            if($result1){
                echo 'farmer account hold successfully.';
                exit(0);
            }
            else{
                echo "farmer account cannot be hold.";
                exit(0);
            }
        }

    }

    // farmer_status_active_btn
    if(isset($_POST['farmer_status_active_btn'])){

        $farmer_id = $_POST['farmer_id'];
    
        $check = "SELECT farmer_status FROM `farmer` WHERE `farmer_id` = '$farmer_id'";
        $result = mysqli_query($conn, $check);
    
        // Count the number of rows with the matching username
        $rowCount = mysqli_num_rows($result);
    
        // If no user is found, show error message
        if($rowCount == 0) {
            echo 'This user details are missing from the system.';
            exit(0);
        }else{

            $row = mysqli_fetch_assoc($result);
            $db_farmer_status = $row['farmer_status'];
    
            if($db_farmer_status == 0){
                echo'This user account is already Active.';
                exit(0);
            }
            $sql = "UPDATE `farmer` SET `farmer_status`= 0 WHERE farmer_id = '$farmer_id'";
            $result1 = mysqli_query($conn, $sql);
            if($result1){
                echo 'farmer account active successfully.';
                exit(0);
            }
            else{
                echo "farmer account cannot be active.";
                exit(0);
            }
            
        }


    }

    // supplier_detail_update
    if(isset($_POST['supplier_detail_update'])){

        $update_supplier_id = $_POST['update_supplier_id'];
        $update_supplier_name = $_POST['update_supplier_name'];
        $update_shop_name = $_POST['update_shop_name'];
        $update_shop_address = $_POST['update_shop_address'];

        if(isset($_FILES['supplier_proof_doc'])){
            $supplier_proof_doc = $_FILES['supplier_proof_doc']['name'];
            $image_temp_name = $_FILES['supplier_proof_doc']['tmp_name'];
            $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\admin\\images\\user/$supplier_proof_doc";     
        }

        if(!empty($supplier_proof_doc)){

            $sql = "SELECT supplier_proof FROM `supplier` WHERE `supplier_id` = '$update_supplier_id'";
            $result = mysqli_query($conn, $sql);

            if($result->num_rows > 0){

                $row = $result->fetch_assoc();
    
                $filePath = 'images/user/' . $row['supplier_proof'];
    
                // Delete the file from the server
                if(file_exists($filePath)){ 
    
                    unlink($filePath);

                    if(move_uploaded_file($image_temp_name,$image_destination)){

                        $supplier_proof_doc = mysqli_real_escape_string($conn, $supplier_proof_doc);
                        $update_supplier_name = mysqli_real_escape_string($conn, $update_supplier_name);
                        $update_shop_name = mysqli_real_escape_string($conn, $update_shop_name);
                        $update_shop_address = mysqli_real_escape_string($conn, $update_shop_address);
        
                        $sql= "UPDATE `supplier` SET 
                        `supplier_name`='$update_supplier_name',
                        `supplier_shop_name`='$update_shop_name',
                        `supplier_address`='$update_shop_address',
                        `supplier_proof`='$supplier_proof_doc' WHERE `supplier_id`='$update_supplier_id' ";
                        
                        $result = mysqli_query($conn,$sql);
        
                        if($result){
                            $_SESSION['user_info_msg'] = "Supplier details update successfully";
                            header('location: user.php');
                            exit();
                        }else{
                            $_SESSION['user_info_msg'] = "Supplier details update Failed!,Try Again";
                            header('location: user.php');
                            exit();
                        }
        
                    }else{
                        $_SESSION['user_info_msg'] = "Please select a image to upload for update!";
                        header("Location: user.php");
                        exit();
                    }
    
                }else{
                    $_SESSION['user_info_msg'] = "Supplier proof document missing!";
                    header('location: user.php');
                    exit();
                }
    
            } else {
                $_SESSION['user_info_msg'] = "Supplier proof document not found!";
                header('location: user.php');
                exit();
            }

            

        }else{

            $update_supplier_name = mysqli_real_escape_string($conn, $update_supplier_name);
            $update_shop_name = mysqli_real_escape_string($conn, $update_shop_name);
            $update_shop_address = mysqli_real_escape_string($conn, $update_shop_address);

            $sql= "UPDATE `supplier` SET 
            `supplier_name`='$update_supplier_name',
            `supplier_shop_name`='$update_shop_name',
            `supplier_address`='$update_shop_address' WHERE `supplier_id`='$update_supplier_id' ";
            
            $result = mysqli_query($conn,$sql);

            if($result){
                $_SESSION['user_info_msg'] = "Supplier details update successfully";
                header('location: user.php');
                exit();
            }else{
                $_SESSION['user_info_msg'] = "Supplier details update Failed!,Try Again";
                header('location: user.php');
                exit();
            }
        }


    }

    // farmer_detail_update
    if(isset($_POST['farmer_detail_update'])){

        $update_farmer_id = $_POST['update_farmer_id'];
        $update_farmer_name = $_POST['update_farmer_name'];
        $update_farmer_address = $_POST['update_farmer_address'];

        if(isset($_FILES['farmer_proof_doc'])){
            $farmer_proof_doc = $_FILES['farmer_proof_doc']['name'];
            $image_temp_name = $_FILES['farmer_proof_doc']['tmp_name'];
            $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\admin\\images\\user/$farmer_proof_doc";     
        }

        if(!empty($farmer_proof_doc)){

            $sql = "SELECT farmer_proof FROM `farmer` WHERE `farmer_id` = '$update_farmer_id'";
            $result = mysqli_query($conn, $sql);

            if($result->num_rows > 0){

                $row = $result->fetch_assoc();
    
                $filePath = 'images/user/' . $row['farmer_proof'];
    
                // Delete the file from the server
                if(file_exists($filePath)){ 
    
                    unlink($filePath);

                    if(move_uploaded_file($image_temp_name,$image_destination)){

                        $farmer_proof_doc = mysqli_real_escape_string($conn, $farmer_proof_doc);
                        $update_farmer_name = mysqli_real_escape_string($conn, $update_farmer_name);
                        $update_farmer_address = mysqli_real_escape_string($conn, $update_farmer_address);
        
                        $sql= "UPDATE `farmer` SET 
                        `farmer_name`='$update_farmer_name',
                        `farmer_address`='$update_farmer_address',
                        `farmer_proof`='$farmer_proof_doc' WHERE `farmer_id`='$update_farmer_id' ";
                        
                        $result = mysqli_query($conn,$sql);
        
                        if($result){
                            $_SESSION['farmer_info_msg'] = "farmer details update successfully";
                            header('location: farmer_info.php');
                            exit();
                        }else{
                            $_SESSION['farmer_info_msg'] = "farmer details update Failed!,Try Again";
                            header('location: farmer_info.php');
                            exit();
                        }
        
                    }else{
                        $_SESSION['farmer_info_msg'] = "Please select a image to upload for update!";
                        header("Location: farmer_info.php");
                        exit();
                    }
    
                }else{
                    $_SESSION['farmer_info_msg'] = "farmer proof document missing!";
                    header('location: farmer_info.php');
                    exit();
                }
    
            } else {
                $_SESSION['farmer_info_msg'] = "farmer proof document not found!";
                header('location: farmer_info.php');
                exit();
            }

            

        }else{

            $update_farmer_name = mysqli_real_escape_string($conn, $update_farmer_name);
            $update_farmer_address = mysqli_real_escape_string($conn, $update_farmer_address);

            $sql= "UPDATE `farmer` SET 
            `farmer_name`='$update_farmer_name',
            `farmer_address`='$update_farmer_address' WHERE `farmer_id`='$update_farmer_id' ";
            
            $result = mysqli_query($conn,$sql);

            if($result){
                $_SESSION['farmer_info_msg'] = "Farmer details update successfully";
                header('location: farmer_info.php');
                exit();
            }else{
                $_SESSION['farmer_info_msg'] = "Farmer details update Failed!,Try Again";
                header('location: farmer_info.php');
                exit();
            }
        }


    }

    // redirect to index page
    if (
        !isset($_POST["admin_profile_update_btn"]) &&
        !isset($_POST["staff_profile_update_btn"]) &&
        !isset($_POST["admin_password_update_btn"]) &&
        !isset($_POST["staff_password_update_btn"]) &&
        !isset($_POST["verity_id"]) &&
        !isset($_POST["verities_update"]) &&
        !isset($_POST["froget_password_update"]) &&
        !isset($_POST["staff_detail_update"]) &&
        !isset($_POST["customer_status_hold_btn"]) &&
        !isset($_POST["customer_status_active_btn"]) &&
        !isset($_POST["supplier_status_hold_btn"]) &&
        !isset($_POST["supplier_status_active_btn"]) &&
        !isset($_POST["farmer_status_hold_btn"]) &&
        !isset($_POST["farmer_status_active_btn"]) &&
        !isset($_POST["supplier_detail_update"]) &&
        !isset($_POST["farmer_detail_update"])
    ) {
        header('Location: index.php');
        exit(0);
    }
    

?>