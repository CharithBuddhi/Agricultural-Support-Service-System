<?php 
session_start();
require ('db_conn.php');
date_default_timezone_set('Asia/Calcutta');

if(isset($_POST['harvest_submit'])){
    $crop = trim($_POST['crop']);
    $variety = trim($_POST['variety']);
    $yala_start = trim($_POST['yala_start']);
    $yala_end = trim($_POST['yala_end']);
    $maha_start = trim($_POST['maha_start']);
    $maha_end = trim($_POST['maha_end']); 

    if($yala_start==$yala_end){
        $_SESSION['harvest_msg'] = "Can't Yala Start Data and End Date Same";
        header('location:price.php');
        exit();
    }else if($maha_start==$maha_end){
        $_SESSION['harvest_msg'] = "Can't Maha Start Data and End Date Same";
        header('location:price.php');
        exit();
    }else if($yala_start > $yala_end || $maha_start > $maha_end){
        $_SESSION['harvest_msg'] = "Start Date should be less than End Date";
        header('location:price.php');
        exit();
    }else{

        // check if harvest month already added
        $run = "SELECT * FROM `harvest` WHERE crop_name = '$crop' AND crop_variety = '$variety'";
        $result = mysqli_query($conn,$run);
        $row = mysqli_num_rows($result);
        if($row > 0){
            $_SESSION['harvest_msg'] = "Harvest month already added";
            header('location:price.php');
            exit();
        }else{
            $sql= "INSERT INTO `harvest`(`crop_name`, `crop_variety`, `yala_start`, `yala_end`, `maha_start`, `maha_end`)
             VALUES ('$crop','$variety','$yala_start','$yala_end','$maha_start','$maha_end')";
            
            $result = mysqli_query($conn,$sql);
    
            if($result){
                $_SESSION['harvest_msg'] = "Harvest month added successfully";
                header('location:price.php');
                exit();
            }else{
                $_SESSION['harvest_msg'] = "Harvest month added failed";
                header('location:price.php');
                exit();
            }

        }

    }

}

if(isset($_POST['technology_submit'])){

    $video_name = trim($_POST['video_name']);

    $video_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\admin\\videos/";
    
    // Get the video save temporary location
    $video = $_FILES['file']["name"];
    $video_tmp_name = $_FILES['file']['tmp_name'];
    
    // Get the file extension of the uploaded image
    $fileExtension = pathinfo($video, PATHINFO_EXTENSION);

    $newFileName = $video_name . "_" . time() . "." . $fileExtension;

    // Define the complete target path with the new file name
    $targetFilePath = $video_destination . $newFileName;

    $error = $_FILES['file']['error'];
    
    if(!empty($video_name)){
        
        if($error === 0){
    
            if(move_uploaded_file($video_tmp_name,$targetFilePath )){

                $response = $_SESSION['login_staff_user']; 
        
                $sql = "INSERT INTO technology(video_name, view_name, response) VALUES ('$newFileName','$video_name','$response')";
                $result= mysqli_query($conn,$sql);
                if($result){
                    $_SESSION['technology'] = "New Techniques Uploaded successfully!";
                    header("Location: technology.php");
                    exit();
                }else{
                    $_SESSION['technology'] = "Techniques Uploaded Failed!,Try Again";
                    header("Location: technology.php");
                    exit();
                }
            }else{
                $_SESSION['technology'] = "Please select a video to upload";
                header("Location: technology.php");
                exit();
            }
    
        }else{
            $_SESSION['technology'] = "The file size is too large.Maximumx size 200Mb";
            header("Location: technology.php");
            exit();
        }
    }else{
        $_SESSION['technology'] = "Please fill the all input field!";
        header("Location: technology.php");
        exit();

    }



}

if(isset($_POST['verities_submit'])){

    $id = $_SESSION['login_staff_user'];

    $Product_name = trim($_POST['Product_name']);
    $Verities_name = trim($_POST['Verities_name']);
    $Origin = trim($_POST['Origin']);
    $Days_Maturity = trim($_POST['Days_Maturity']);
    $Category = trim($_POST['Category']);
    $Verities_image = trim($_FILES['Verities_image']['name']);
    $image_temp_name = trim($_FILES['Verities_image']['tmp_name']);
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

    $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\admin\\images\\verity/$Verities_image";
 
    // check if variteis details already added
    $run = "SELECT * FROM `verity` WHERE product_name = '$Product_name' AND verity_name = '$Verities_name'";
    $result = mysqli_query($conn,$run);
    $row = mysqli_num_rows($result);
    if($row > 0){
        $_SESSION['verity_status'] = "This verities is already added";
        header('location:variety.php');
        exit();
    }else{

        if(!empty($Verities_image)){

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

                $sql= "INSERT INTO `verity`(`product_category`, `product_name`, `verity_name`, `Days_Maturity`, `Verities_image`, `Description`, `Light`, `Water`, `Nutrient`, `Soil`, `distance`, `depth`, `spacing`, `Harvest_message`, `Companion`, `Antagonistic`, `Diseases`, `Pests`, `Origin`, `reponsible`) 
                VALUES ('$Category','$Product_name','$Verities_name','$Days_Maturity','$Verities_image','$Description','$Light','$Water','$Nutrient','$Soil','$distance','$depth','$spacing','$Harvest_message','$Companion','$Antagonistic','$Diseases','$Pests','$Origin','$id')";
                
                $result = mysqli_query($conn,$sql);

                if($result){
                    $_SESSION['verity_status'] = "Verities details added successfully";
                    header('location:variety.php');
                    exit();
                }else{
                    $_SESSION['verity_status'] = "Verities details added Failed!,Try Again";
                    header('location:variety.php');
                    exit();
                }

            }else{
                $_SESSION['verity_status'] = "Please select a image to upload";
                header("Location: variety.php");
                exit();
            }

        }else{
            $_SESSION['verity_status'] = "Please fill the all input field.Here not include image!";
            header("Location: variety.php");
            exit();
        }

    }

    

}

if(isset($_POST['registar_staff'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $response = $_SESSION['login_admin_user'];

    if(empty(trim($name)) || empty(trim($email)) || empty(trim($username)) || empty(trim($password)) || empty(trim($role)) || empty(trim($response))){  
        $_SESSION['staff_reg_msg'] = "Please fill the all input field";
        header('location:staff_info.php');
        exit();
    
    }else{

        // Check if username exists
        $SELECT = "SELECT staff_userName FROM staff WHERE staff_userName = ? LIMIT 1";
        $INSERT = "INSERT INTO staff (staff_name, staff_userName, staff_password, staff_email, staff_type, reponse, update_date) values(?, ?, ?, ?, ?, ?, ?)";

        // prepare statment
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        $now = date('Y-m-d H:i:s');

        if($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssss", $name, $username, $password, $email, $role, $response, $now);
            $stmt->execute();
            $_SESSION['staff_reg_msg'] = "Registered successfully!";
            $stmt->close();
            $conn->close();
            header("Location: staff_info.php");
            exit();
        }else{
            $_SESSION['staff_reg_msg'] = "Someone already register using this username";
            header("Location: staff_info.php");
            exit();
        }

    }

}

if(empty($_POST["harvest_submit"]) && empty($_POST["technology_submit"]) && empty($_POST["verity_submit"]) && empty($_POST["registar_staff"])){
    header('Location: index.php');
    exit(0);
}

?>