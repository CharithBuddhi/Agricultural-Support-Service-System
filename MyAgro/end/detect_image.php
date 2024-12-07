<?php
session_start();
// save image to folder  
if (isset($_POST['detect_image'])) {

    $image_Name = $_FILES['image']['name'];
    $image_temp_name = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    
    // Get the file extension of the uploaded image
    $fileExtension = pathinfo($image_Name, PATHINFO_EXTENSION);

    if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "PNG" || $fileExtension == "JPG" || $fileExtension == "JPEG"){

        // get only image name without extension
        $image_Name = pathinfo($image_Name, PATHINFO_FILENAME);


        $newFileName = $image_Name . "_" . time() . "." . $fileExtension;
        $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\yolov8_env\\try_data/$newFileName";
        // $image_destination = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\yolov8_env\\try_data\\ima.jpg"; // Example path

        if ($fileError === 0) {

            // check file size less than 20mb
            if ($fileSize < 20000000) {

                if(move_uploaded_file($image_temp_name,$image_destination)){

                    // Define the paths
                    $pythonPath = "D:\\software\\conda\\envs\\yolov8_env\\python.exe"; 
                    $scriptPath = "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\yolov8_env\\detect.py";

                    // Execute the Python script
                    $result = exec($pythonPath . " " . escapeshellarg($scriptPath) . " " . escapeshellarg($newFileName), $output, $return_var);

                    // Log output and return code for debugging pupose
                    file_put_contents("log.txt", "Result: " . print_r($result, true) . PHP_EOL);
                    file_put_contents("log.txt", "Output: " . print_r($output, true) . PHP_EOL, FILE_APPEND);
                    file_put_contents("log.txt", "Return Code: " . $return_var . PHP_EOL, FILE_APPEND);

                    // Check if execution was successful
                    if ($return_var === 0 && !empty($result)) {
                        echo $result;



                    } else {
                        echo "Error:". $result;
                    }


                }else{
                    $_SESSION['detect'] = "This image has not been uploaded...";  
                    header("Location: nutrients.php");
                }

            } else {
                echo "Your file is too big!";
                $_SESSION['detect'] = "Your file is too big! Accepted file size less than 10mb";  
                header("Location: nutrients.php");
            }

        } else {
            $_SESSION['detect'] = "There was an error uploading your file!";  
            header("Location: nutrients.php");
        }

    }else{
        $_SESSION['detect'] = "This image format is not supported...";  
        header("Location: nutrients.php");
    }


}

?>