<?php 

    require('db_conn.php');

    // control price delete function
    if(isset($_POST['price_delete_btn'])){

        $price_id = mysqli_real_escape_string($conn, $_POST['price_id']);
        $sql = "DELETE FROM controlprice WHERE price_id = '$price_id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo 200;
        }
        else{
            echo 500;
        }
    }

    // inqury delete function
    if(isset($_POST['inqury_delete_btn'])){

        $notify_id = mysqli_real_escape_string($conn, $_POST['notify_id']);
        $sql = "DELETE FROM inquiry WHERE notify_id = '$notify_id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo 200;
        }
        else{
            echo 500;
        }
    }

    // Request delete function
    if(isset($_POST['request_delete_btn'])){

        $request_id = mysqli_real_escape_string($conn, $_POST['request_id']);

        $check = "SELECT proof_image FROM request WHERE request_id = '$request_id'";

        $query_run = mysqli_query($conn, $check);

        if($query_run->num_rows > 0){

            $row = $query_run->fetch_assoc();

            $filePath = 'images/reg/' . $row['proof_image'];

            // Delete the file from the server
            if(file_exists($filePath)){ 

                unlink($filePath);

                // Delete the record from the database
                $sql = "DELETE FROM request WHERE request_id = '$request_id'";
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

    // Harvestin month delete function
    if(isset($_POST['harvest_delete_btn'])){

        $harvest_id = mysqli_real_escape_string($conn, $_POST['harvest_id']);
        $sql = "DELETE FROM harvest WHERE harvest_id = '$harvest_id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo 200;
        }
        else{
            echo 500;
        }
    }

    // Technology details delete function
    if(isset($_POST['technology_delete_btn'])){

        $tech_id = mysqli_real_escape_string($conn, $_POST['tech_id']);

        $check = "SELECT video_name FROM technology WHERE tech_id = '$tech_id'";

        $query_run = mysqli_query($conn, $check);

        if($query_run->num_rows > 0){

            $row = $query_run->fetch_assoc();

            $filePath = 'videos/' . $row['video_name'];

            // Delete the file from the server
            if(file_exists($filePath)){ 

                unlink($filePath);

                // Delete the record from the database
                $sql = "DELETE FROM technology WHERE tech_id = '$tech_id'";
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

?>