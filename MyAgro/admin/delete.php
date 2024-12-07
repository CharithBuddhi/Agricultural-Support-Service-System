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

    // Varities details delete function
    if(isset($_POST['verity_delete_btn'])){

        $verity_id = mysqli_real_escape_string($conn, $_POST['verity_id']);

        $check = "SELECT Verities_image FROM verity WHERE verity_id = '$verity_id'";

        $query_run = mysqli_query($conn, $check);

        if($query_run->num_rows > 0){

            $row = $query_run->fetch_assoc();

            $filePath = 'images/verity/' . $row['Verities_image'];

            // Delete the file from the server
            if(file_exists($filePath)){ 

                unlink($filePath);

                // Delete the record from the database
                $sql = "DELETE FROM verity WHERE verity_id = '$verity_id'";
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

    // Nutrients details delete function
    if(isset($_POST['nutrient_delete_btn'])){

        $nutrient_id = mysqli_real_escape_string($conn, $_POST['nutrient_id']);

        $check = "SELECT * FROM nutrition WHERE nutrient_id = '$nutrient_id'";

        $query_run = mysqli_query($conn, $check);

        if($query_run->num_rows > 0){

            // Delete the record from the database
            $sql = "DELETE FROM nutrition WHERE nutrient_id = '$nutrient_id'";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo 200;
            }
            else{
                echo 500;
            }

        } else {
            echo "Cannot find this nutrition details.";
        } 

    }

    // staff members details delete function
    if(isset($_POST['staff_delete_btn'])){

        $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);

        $check = "SELECT * FROM staff WHERE staff_id = '$staff_id'";

        $query_run = mysqli_query($conn, $check);

        if($query_run->num_rows > 0){

            $row = $query_run->fetch_assoc();

            $db_staff_id = $row['staff_id'];

            // Delete the record from the database
            $sql = "DELETE FROM staff WHERE staff_id = '$db_staff_id'";
            $result = mysqli_query($conn, $sql);
            if($result){

                echo 200;
            }
            else{

                echo 500;
            }

        } else {
            echo "Cannot find this member details.";
        }
        
    }

    // customer details delete function
    if(isset($_POST['customer_detail_delete_btn'])){

        $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);

        $check = "SELECT * FROM customer WHERE customer_id = '$customer_id'";

        $query_run = mysqli_query($conn, $check);

        if($query_run->num_rows > 0){

            $row = $query_run->fetch_assoc();

            $db_customer_id = $row['customer_id'];

            // Delete the record from the database
            $sql = "DELETE FROM customer WHERE customer_id = '$db_customer_id'";
            $result = mysqli_query($conn, $sql);
            if($result){

                echo 200;
            }
            else{

                echo 500;
            }

        } else {
            echo "Cannot find this customer details in system.";
        }
        
    }

    // supplier_detail_delete_btn details delete function
    if(isset($_POST['supplier_detail_delete_btn'])){

        $supplier_id = mysqli_real_escape_string($conn, $_POST['supplier_id']);

        $check = "SELECT supplier_proof FROM supplier WHERE supplier_id = '$supplier_id'";

        $query_run = mysqli_query($conn, $check);

        if($query_run->num_rows > 0){

            $row = $query_run->fetch_assoc();

            $filePath = 'images/user/' . $row['supplier_proof'];

            // Delete the file from the server
            if(file_exists($filePath)){ 

                unlink($filePath);

                // Delete the record from the database
                $sql = "DELETE FROM supplier WHERE supplier_id = '$supplier_id'";
                $result = mysqli_query($conn, $sql);
                if($result){

                    echo 200;
                }
                else{
                    echo 500;
                }

            }else{
                echo "This supplier proof document are missin.";
            }

        } else {
            echo "This supplier proof document are not found.";
        }
        
    }

    // redirect to index page
    if (
        !isset($_POST["price_delete_btn"]) &&
        !isset($_POST["inqury_delete_btn"]) &&
        !isset($_POST["harvest_delete_btn"]) &&
        !isset($_POST["technology_delete_btn"]) &&
        !isset($_POST["verity_delete_btn"]) &&
        !isset($_POST["staff_delete_btn"]) &&
        !isset($_POST["customer_detail_delete_btn"]) &&
        !isset($_POST["supplier_detail_delete_btn"]) &&
        !isset($_POST["nutrient_delete_btn"])
    ) {
        header('Location: index.php');
        exit(0);
    }
?>