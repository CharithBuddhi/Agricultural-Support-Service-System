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

        $id = $_GET['id'];

        $result = mysqli_query($conn,"UPDATE `request` SET `user_action`='1' WHERE request_id = '$id'");

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
        $tel_no = $row['tel_no'];
        $proof = $row['proof_image'];
        $image_path = 'images/reg/'.$proof;
        $new_path = 'images/user/'.$proof;


        switch($user_type){
            case "farmer":
                $send = "INSERT INTO farmer(`farmer_name`, `farmer_username`, `farmer_password`, `farmer_nic`, `farmer_email`, `farmer_address`, `farmer_phone`, `farmer_proof`) 
                VALUES ('$name','$username',' $password','$nic','$email','$address','$tel_no','$proof')";

                $result = mysqli_query($conn,$send);

                // move image old folder to new folder
                rename($image_path, $new_path);
                header('Location: request.php');
                break;

            case "supplier":
                
                break;
        }
    ?>

    </form>
</body>
</html>