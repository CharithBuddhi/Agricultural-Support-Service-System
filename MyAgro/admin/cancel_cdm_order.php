<?php

    include('db_conn.php');
    // using IN check multiple values for payment_status
    // DATE_SUB(date, INTERVAL value unit)   unit: such as MINUTE, HOUR, DAY, etc. INTERVAL == duration of time
    // here decrease 10 minutes from current time then check that decrease time more then create time.

    $SELECT = "SELECT * FROM `transaction` WHERE `payment_status` IN ('Rejected', 'Pending') AND `created` < DATE_SUB(NOW(), INTERVAL 2 MINUTE)";
    $result = $conn->query($SELECT);
    
    // Check if the query execution was successful
    if ($result === false) {

        die("Query failed: " . $conn->error);
    }
    
    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

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

                header("Location: staff.php");
                exit();
        
            }else if($item_category == "vegetable" || $item_category == "fruit"){

                $SELECT = "SELECT vegfruit_total FROM `vegetablefruit` WHERE `vegfruitle_id` = '$item_id'";
                $result1 = $conn->query($SELECT);
                $row = $result1->fetch_assoc();
                $db_quantity = $row['vegfruit_total'];

                $total_quantity = $db_quantity + $order_quantity;
                $sql = "UPDATE `vegetablefruit` SET `vegfruit_total`='$total_quantity' WHERE `vegfruit_total` = '$item_id'";            
                $result = $conn->query($sql);

                $sql = "UPDATE `transaction` SET `payment_status` = 'Canceled' , `update_time` = NOW() WHERE `Reference_id` = '$order_id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                header("Location: staff.php");
                exit();

            }

        }
    }else {
        header("Location: staff.php");
        exit();
    }
    

?>