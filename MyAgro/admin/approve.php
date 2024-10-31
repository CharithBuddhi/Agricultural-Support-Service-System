<?php session_start();
if(!isset($_SESSION['login_staff_user'])){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
    <?php 

        require('db_conn.php');

        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $sql ="SELECT * FROM request WHERE request_id = '$id' LIMIT 1";
            $result = mysqli_query($conn,$sql);
            
            $row =mysqli_fetch_assoc($result);
            
            $name = $row['your_name'];
            $username = $row['username'];
            $password = $row['user_password'];
            $user_type = $row['user_type'];
            $nic = $row['nic_number'];
            $address = $row['user_address'];
            $email = $row['user_email'];
            $shop_name = $row['shop_name'];
            $tel_no = $row['tel_no'];
            $proof = $row['proof_image'];
            $image_path = 'images/reg/'.$proof;
            $new_path = 'images/user/'.$proof;
            $response = $_SESSION['login_staff_user'];     
            
            // $result = mysqli_query($conn,"UPDATE `request` SET `user_action`='1' WHERE request_id = '$id'");

            switch($user_type){
                case "farmer":
                    $send = "INSERT INTO farmer(`farmer_name`, `username`, `password`, `farmer_nic`, `farmer_email`, `farmer_address`, `farmer_phone`, `farmer_proof`, `response`) 
                    VALUES ('$name','$username',' $password','$nic','$email','$address','$tel_no','$proof','$response')";

                    $result = mysqli_query($conn,$send);

                    // move image old folder to new folder
                    rename($image_path, $new_path);
                    $result = mysqli_query($conn,"UPDATE `request` SET `user_action`='1' WHERE request_id = '$id'");
                    $_SESSION['request_status'] = "Farmer registraion successfull";
                    header('Location: request.php');
                    break;

                case "supplier":
                    $send = "INSERT INTO supplier( `supplier_name`, `username`, `password`, `supplier_nic`, `supplier_shop_name`, `supplier_email`, `supplier_address`, `supplier_phone`, `supplier_proof`, `response`)
                    VALUES ('$name','$username','$password','$nic','$shop_name','$email','$address','$tel_no','$proof','$response')";

                    $result = mysqli_query($conn,$send);

                    // move image old folder to new folder
                    rename($image_path, $new_path);
                    $result = mysqli_query($conn,"UPDATE `request` SET `user_action`='1' WHERE request_id = '$id'");
                    $_SESSION['request_status'] = "Supplier registraion successfull";
                    header('Location: request.php');
                    break;
            }

        }else{
            header('Location: request.php');
            exit();
        }
    ?>

    </form>
</body>
</html>