<?php

    require('db_connect.php'); 

    // Agrochemical product delete function
    if(isset($_POST['product_delete_btn'])){

        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

        $check = "SELECT agro_image FROM agrochemical WHERE agro_id = '$product_id'";

        $query_run = mysqli_query($conn, $check);

        if($query_run->num_rows > 0){

            $row = $query_run->fetch_assoc();
      
            $filePath = 'images/fertilizer/saveferti/' . $row['agro_image'];
                       
            // Delete the file from the server
            if(file_exists($filePath)){ 

                unlink($filePath);

                // Delete the record from the database
                $sql = "DELETE FROM agrochemical WHERE agro_id = '$product_id'";
                $result = mysqli_query($conn, $sql);
                if($result){

                    echo 200;
                }
                else{
                    echo 500;
                }

            }else{
                echo "This file are missin.";
            }

        } else {
            echo "This file are not found.";
        }

            
    }

    // Agrochemical product delete function
    if(isset($_POST['vegetable_delete_btn'])){

        $vegetable_id = $_POST['vegetable_id'];

        $check = "SELECT vegfruit_image FROM vegetablefruit WHERE vegfruitle_id = '$vegetable_id'";

        $query_run = mysqli_query($conn, $check);

        if($query_run->num_rows > 0){

            $row = $query_run->fetch_assoc();
      
            $filePath = 'images/vegetable/' . $row['vegfruit_image'];
                       
            // Delete the file from the server
            if(file_exists($filePath)){ 

                unlink($filePath);

                // Delete the record from the database
                $sql = "DELETE FROM vegetablefruit WHERE vegfruitle_id = '$vegetable_id'";
                $result = mysqli_query($conn, $sql);
                if($result){

                    echo 200;
                }
                else{
                    echo 500;
                }

            }else{
                echo "This file are missin.";
            }

        } else {
            echo "This file are not found.";
        }

            
    }

    if (!isset($_POST["product_delete_btn"]) && !isset($_POST["vegetable_delete_btn"])) {
        header('Location: index.php');
        exit(0);
    }

?>