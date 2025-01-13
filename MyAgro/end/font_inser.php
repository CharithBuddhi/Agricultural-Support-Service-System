<?php

session_start();
require('db_connect.php'); 
date_default_timezone_set('Asia/Colombo');

if(isset($_POST['product_submit'])){

    $login_user_type = $_SESSION['login_type'];
    $id = $_SESSION['login_id'];

    if($login_user_type == "supplier"){
        $supplier_id = $id;
        $select = "SELECT bank_name, account_name, account_no, branch_name FROM supplier WHERE supplier_id = '$supplier_id'";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_assoc($result);
        $bank_name = $row['bank_name'];
        $account_name = $row['account_name'];
        $account_no = $row['account_no'];
        $branch_name = $row['branch_name'];

        if($bank_name == "" || $account_name == "" || $account_no == "" || $branch_name == ""){
            $_SESSION['product_manage'] = "Please fill your bank details first!";
            header("Location: product_manage.php");
            exit();
        }

    }else{
        $_SESSION['product_manage'] = "You are not supplier!";
        header("Location: product_manage.php");
        exit();
    }

    $Product_name = trim($_POST['Product_name']);
    $Origin = trim($_POST['Origin']);

    if(isset($_POST['Category_chemical'])){
        $Category = trim($_POST['Category_chemical']);
    }else if(isset($_POST['Category_fertilizer'])){
        $Category = trim($_POST['Category_fertilizer']);
    }

    $type = trim($_POST['type']);
    
    $iso_number = $_POST['iso_number'];
    $sls_number = trim($_POST['sls_number']);
    
    $product_image = trim($_FILES['Product_image']['name']);
    $image_temp_name = trim($_FILES['Product_image']['tmp_name']);
    $Description = trim($_POST['Description']);
    

    $shop_name = trim($_POST['shop_name']);
    $product_price = trim($_POST['product_price']);

    $commission = round(($product_price * 0.02),2);
    
    $product_quantity = trim($_POST['product_quantity']);
    $total_quantity = trim($_POST['total_quantity']);
    $measurement = trim($_POST['measurement']);

    $district = trim($_POST['district']);
    $area = trim($_POST['area']);
    $address = trim($_POST['address']);

    $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\end\\images\\fertilizer\\saveferti/$product_image";

    if(!empty($product_image)){

        if(move_uploaded_file($image_temp_name,$image_destination)){

            $sql = "INSERT INTO agrochemical (agro_name, 
                                            agro_category,
                                            fertilizer_category,
                                            fertilizer_type,
                                            iso_id, 
                                            sls_id, 
                                            agro_image, 
                                            agro_description,
                                            shop_name, 
                                            agro_price,
                                            commission, 
                                            agro_quantity, 
                                            total_quantity, 
                                            meassure, 
                                            agro_district, 
                                            agro_area, 
                                            agro_location, 
                                            supplier_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssddddssssi", $Product_name, 
                                                            $Origin, 
                                                            $Category, 
                                                            $type, 
                                                            $iso_number, 
                                                            $sls_number, 
                                                            $product_image, 
                                                            $Description, 
                                                            $shop_name, 
                                                            $product_price,
                                                            $commission, 
                                                            $product_quantity, 
                                                            $total_quantity, 
                                                            $measurement, 
                                                            $district, 
                                                            $area, 
                                                            $address, 
                                                            $id);
            $insert = $stmt->execute();

            if($insert){
                $_SESSION['product_manage'] = "Product details added successfully";
                header('location:product_manage.php');
                exit();
            }else{
                $_SESSION['product_manage'] = "Product details added Failed!,Try Again";
                header('location:product_manage.php');
                exit();
            }

        }else{
            $_SESSION['product_manage'] = "Please select a image to upload";
            header("Location: product_manage.php");
            exit();
        }

    }else{
        $_SESSION['verity_status'] = "Please fill the all input field.Here not include image!";
        header("Location: product_manage.php");
        exit();
    }

}

if(isset($_POST['vegetable_submit'])){

    $login_user_type = $_SESSION['login_type'];
    $id = $_SESSION['login_id'];

    if($login_user_type == "farmer"){
        $farmer_id = $id;
        $select = "SELECT bank_name, account_name, account_no, branch_name FROM farmer WHERE farmer_id = '$farmer_id'";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_assoc($result);
        $bank_name = $row['bank_name'];
        $account_name = $row['account_name'];
        $account_no = $row['account_no'];
        $branch_name = $row['branch_name'];

        if($bank_name == "" || $account_name == "" || $account_no == "" || $branch_name == ""){
            $_SESSION['vegetable_manage'] = "Please fill your bank details first!";
            header("Location: vegetable_manage.php");
            exit();
        }

    }else{
        $_SESSION['vegetable_manage'] = "You are not farmer!";
        header("Location: vegetable_manage.php");
        exit();
    }

    $Product_Origin = trim($_POST['Product_Origin']);
    $Product_name = trim($_POST['Product_Category']);
    $Product_varity = trim($_POST['Product_name']);
    
    $product_image = trim($_FILES['Product_image']['name']);
    $image_temp_name = trim($_FILES['Product_image']['tmp_name']);

    $product_price = trim($_POST['product_price']);
    $total_quantity = trim($_POST['total_quantity']);
    $measurement = "Kg";

    $district = trim($_POST['district']);
    $area = trim($_POST['area']);
    $address = trim($_POST['address']);

    $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\end\\images\\vegetable/$product_image";

    if(!empty($product_image)){

        if(move_uploaded_file($image_temp_name,$image_destination)){

            $sql = "INSERT INTO vegetablefruit (vegetable_category, 
                                            vegetable_name,
                                            vegfruitle_verity,
                                            vegfruit_distric,
                                            vegfruit_area, 
                                            vegfruit_location, 
                                            vegfruit_image, 
                                            vegfruit_price,
                                            vegfruit_total, 
                                            measurement, 
                                            farmer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssddsi", $Product_Origin, 
                                                    $Product_name, 
                                                    $Product_varity, 
                                                    $district, 
                                                    $area, 
                                                    $address, 
                                                    $product_image, 
                                                    $product_price, 
                                                    $total_quantity, 
                                                    $measurement, 
                                                    $id);
            $insert = $stmt->execute();

            if($insert){
                $_SESSION['vegetable_manage'] = "Product details added successfully";
                header('location:vegetable_manage.php');
                exit();
            }else{
                $_SESSION['vegetable_manage'] = "Product details added Failed!,Try Again";
                header('location:vegetable_manage.php');
                exit();
            }

        }else{
            $_SESSION['vegetable_manage'] = "Please select a image to upload";
            header("Location: vegetable_manage.php");
            exit();
        }

    }else{
        $_SESSION['vegetable_manage'] = "Please fill the all input field.Here not include image!";
        header("Location: vegetable_manage.php");
        exit();
    }

}

if(!isset($_POST['product_submit']) && !isset($_POST['vegetable_submit'])){ 
    header('Location: index.php');
    exit(0);
}

?>