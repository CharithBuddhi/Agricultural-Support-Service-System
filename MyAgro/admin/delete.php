<?php 

    require('db_conn.php');

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


?>