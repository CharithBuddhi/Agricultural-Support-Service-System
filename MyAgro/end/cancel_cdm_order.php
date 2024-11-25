<?php

    require('db_connect.php');
    $SELECT = "SELECT * FROM `transaction` WHERE `payment_status` = 'Rejected'  OR `payment_status` = 'Pending' AND `created` < DATE_SUB(NOW(), INTERVAL 10 MINUTE)";
    $result = $conn->query($SELECT);
    if ($result->num_rows > 0) { 

        while($row = $result->fetch_assoc()) {

            $order_id = $row['Reference_id'];
            $order_quantity = $row['order_quantity'];
            $item_id = $row['item_id'];
            $item_category = $row['item_category'];

            if($item_category == "chemical" || $item_category == "fertilizer"){

                $SELECT = "SELECT total_quantity FROM `agrochemical` WHERE `agro_id` = '$item_id'";
                $result1 = $conn->query($SELECT);
                $row = $result1->fetch_assoc();
                $db_quantity = $row['total_quantity'];

                $total_quantity = $db_quantity + $order_quantity;
                $sql = "UPDATE `agrochemical` SET `total_quantity`='$total_quantity' WHERE `agro_id` = '$item_id'";            
                $result = $conn->query($sql);

                $sql1 = "UPDATE `transaction` SET `payment_status` = 'Canceled' , `update_time` = NOW() WHERE `Reference_id` = '$order_id'";
                $stmt = $conn->prepare($sql1);
                $stmt->execute();
           
            }elseif($item_category == "vegetable" || $item_category == "fruit"){

                $SELECT = "SELECT total_quantity FROM `vegetablefruit` WHERE `agro_id` = '$item_id'";
                $result1 = $conn->query($SELECT);
                $row = $result1->fetch_assoc();
                $db_quantity = $row['total_quantity'];

                $total_quantity = $db_quantity + $order_quantity;
                $sql = "UPDATE `vegetablefruit` SET `total_quantity`='$total_quantity' WHERE `veg_id` = '$item_id'";            
                $result = $conn->query($sql);

                $sql = "UPDATE `transaction` SET `payment_status` = 'Canceled' , `update_time` = NOW() WHERE `Reference_id` = '$order_id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

            }     
       }
   }

?>