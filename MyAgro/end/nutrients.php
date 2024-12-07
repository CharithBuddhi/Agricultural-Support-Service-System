<?php session_start(); ?>
<?php

include('db_connect.php');

$find = false;
$error = "Upload your image and wait a few seconds for the image to be recognized and the results to be displayed!";

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
                        $item = $result;

                        if($item == "Please provide a clear image."){
                            
                            $error = $item;

                        }else{

                            $check = "SELECT * FROM `nutrition` WHERE `item` = '$item'";
                            $result = mysqli_query($conn, $check);
    
                            if($result->num_rows > 0){
    
                                $row = $result->fetch_assoc();
                                $find = true;
                                $item = $row['item'];
                                $item_category = $row['item_category'];
                                $nutrient_amont = $row['nutrient_amont'];
                                $nutrient_valu1 = $row['nutrient_valu1'];
                                $nutrient_valu2 = $row['nutrient_valu2'];
                                $nutrient_valu3 = $row['nutrient_valu3'];
                                $nutrient_valu4 = $row['nutrient_valu4'];
                                $nutrient_valu5 = $row['nutrient_valu5'];
                                $nutrient_valu6 = $row['nutrient_valu6'];
    
                            }else{
                                $error = "This item is not in our database";
                            }
                               
                        }

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
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrients of crop</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <h1 class="my-6 font-serif text-3xl italic font-semibold text-center">Nutrients  of crop</h1>

    <div class="flex justify-center gap-10 pb-20">
        <form action="" method="post" enctype="multipart/form-data" class="flex p-4 flex-col ml-2 border-[1px] border-gray-400 shadow-lg rounded-xl shadow-gray-400">
            <label class="text-red-600 text-md">When inserting a photo, clearly insert the vegetable or fruit as follows.</br> Otherwise, the accuracy of your results may decrease.</label>
            <div class="flex flex-col mt-4">
                <h3>Examples</h3>
                <div class="flex gap-3">
                    <img src="images/orange.png" alt="" class="w-[80px] h-[80px] rounded-xl shadow-lg shadow-gray-400">
                    <img src="images/images.jpg" alt="" class="w-[80px] h-[80px] rounded-xl shadow-lg shadow-gray-400">
                    <img src="images/pineapple.jpg" alt="" class="w-[80px] h-[80px] rounded-xl shadow-lg shadow-gray-400">
                    <img src="images/stawbeary.jpg" alt="" class="w-[80px] h-[80px] rounded-xl shadow-lg shadow-gray-400">
                </div>
            </div>
            <div class="flex flex-col">
                <label for="" class="mt-2">Upload image:</label>
                <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/jpg" class="mt-2 w-[500px] h-[300px] border-2 border-gray-200" required>   
            </div>
            <div class="flex flex-col">
                <label for="" class="mt-2">Accepted file types:</label>
                <div class="relative w-[10px] flex h-[10px] top-5 rounded-full bg-cyan-400"></div>
                <pre for="">  jpg/jpeg,png</pre>
            </div>
            <div class="flex gap-8">
                <button type="reset" class="mt-5 mr-6 h-8 rounded-full w-[145px] bg-white border-2">Clear</button>
                <button type="submit" name="detect_image" class="mt-5 h-8 rounded-full w-[160px] bg-[#6EE70F]/50 text-black">Submit</button>
            </div>
        </form>

        <?php 

        if($find){
            ?>
            <div class="p-4 border-[1px] w-[500px] h-[400px] border-gray-400 shadow-lg rounded-xl shadow-gray-400">
                <div class="flex flex-col gap-3"> 

                    <h1 class="mt-3 text-xl font-semibold text-center">Identify Object Name: <u><?php echo $item; ?></u></h1>
                    
                    <div class="flex gap-3 mt-2 font-medium">
                        <label for="">Item Category :</label>
                        <label for=""><?php echo $item_category; ?></label>
                    </div>
                    
                    <div class="flex gap-3 font-medium">
                        <label for="">Quantity for nutrient analaysis :</label>
                        <label for=""><?php echo $nutrient_amont; ?></label>
                    </div>

                    <label class="font-medium"><?php echo $nutrient_valu1; ?></label>

                    <label class="font-medium"><?php echo $nutrient_valu2; ?></label>

                    <label class="font-medium"><?php echo $nutrient_valu3; ?></label>

                    <label class="font-medium"><?php echo $nutrient_valu4; ?></label>

                    <label class="font-medium"><?php echo $nutrient_valu5; ?></label>

                    <label class="font-medium"><?php echo $nutrient_valu6; ?></label>


                </div>
            </div>
            <?php

        }else{
            ?>
            <label class="flex items-center font-medium text-lg justify-center w-[400px] h-[300px] text-center"><?php echo $error; ?></label> 
            <?php
        }
        ?> 

        
    </div>

    <!-- footer section in home page -->
    <?php require('footer.php'); ?>

    <!-- sweetalert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- show output message -->
    <script>
        var message ="<?php echo isset($_SESSION['detect']) ? $_SESSION['detect'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.
        if (message != "") {
            if(message.includes('analysis')) {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                iconColor: "#69f44a",
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                });
                Toast.fire({
                icon: "success",
                title: message,
                });
            } else {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                iconColor: "#f84444",
                background: "#fcf2f2",
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                });
                Toast.fire({
                icon: "error",
                title: message,
                });
            }
            // remove after once message is shown
            <?php unset($_SESSION['detect']); ?>
        } 
    </script>
    
</body>
</html>