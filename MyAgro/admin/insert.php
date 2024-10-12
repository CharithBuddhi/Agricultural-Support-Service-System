<?php 
session_start();
require ('db_conn.php');

if(isset($_POST['harvest_submit'])){
    $crop = $_POST['crop'];
    $variety = $_POST['variety'];
    $yala_start = $_POST['yala_start'];
    $yala_end = $_POST['yala_end'];
    $maha_start = $_POST['maha_start'];
    $maha_end = $_POST['maha_end']; 

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

    $video_type = $_POST['video_type'];
    $video_name = $_POST['video_name'];

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
    
    if(!empty($video_type) && !empty($video_name)){
        
        if($error === 0){
    
            if(move_uploaded_file($video_tmp_name,$targetFilePath )){
        
                $sql = "INSERT INTO technology(video_name, type,view_name) VALUES ('$newFileName','$video_type','$video_name')";
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

?>