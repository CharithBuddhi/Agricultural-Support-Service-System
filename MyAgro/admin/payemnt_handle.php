<?php
session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $json = file_get_contents('php://input'); // Get raw POST data
        $data = json_decode($json, true); // Decode JSON into PHP array
        
        $status_btn = $data['status_btn'];
        $user = $_SESSION['login_staff_user'];

        include('db_conn.php');

        if($status_btn == "approve"){

            $voucher_id = $data['voucher_id_send'];
            $RP_ID = $data['RP_ID_send'];
            $item_id = $data['item_id_send'];
            
            $UPDATE = "UPDATE `voucher` SET `action`='1', `responsible`='$user', `update_time`= now() WHERE `voucher_id`='$voucher_id'";
            $query = mysqli_query($conn, $UPDATE);
            
            // Process payment (dummy code)
            $_SESSION['payment_status'] = "Cash Deposit Voucher Accepted Successfully!";
        
            // Return a JSON response
            echo json_encode(['status' => 'success', 'message' => 'Payment handled successfully']);
            exit();
        }

        if($status_btn == "reject"){

            $voucher_id = $data['voucher_id_send'];
            $RP_ID = $data['RP_ID_send'];
            $item_id = $data['item_id_send'];

            $UPDATE = "UPDATE `voucher` SET `action`='2', `responsible`='$user', `update_time`= now() WHERE `voucher_id`='$voucher_id'";
            $query = mysqli_query($conn, $UPDATE);

            $UPDATE = "UPDATE `transaction` SET `payment_status`='Rejected', `responsible`='$user', `update_time`= now() WHERE `Reference_id`='$RP_ID' AND `item_id`='$item_id'";
            $query = mysqli_query($conn, $UPDATE);
            
            // Process payment (dummy code)
            $_SESSION['payment_status'] = "Cash Deposit Voucher Rejected!";
        
            // Return a JSON response
            echo json_encode(['status' => 'success', 'message' => 'Payment handled successfully']);
            exit();
        }

        if($status_btn == "db_cancel"){

            $RP_ID = $data['RP_ID_send'];
            $customer_id = $data['customer_id_send'];

            $UPDATE = "UPDATE `transaction` SET `payment_status`='Canceled', `responsible`='$user', `update_time`= now() WHERE `Reference_id`='$RP_ID' AND `customer_id`='$customer_id'";
            $query = mysqli_query($conn, $UPDATE);
            
            // Process payment (dummy code)
            $_SESSION['payment_status'] = "Order Cancelled Successfully!";
        
            // Return a JSON response
            echo json_encode(['status' => 'success', 'message' => 'Order cancelled successfully']);
            exit();
        }

    }

    if(isset($_POST['payment_accept_update'])){

        $send_db_customer_id = $_POST['send_db_customer_id'];
        $send_RP_ID = $_POST['send_RP_ID'];
        $send_product_id = $_POST['send_product_id'];
        $send_amount_due = $_POST['send_amount_due'];

        $UPDATE = "UPDATE `transaction` SET `payment_status`='succeeded', `paid_currency`='lkr', `paid_amount`='$send_amount_due', `responsible`='$user', `update_time`= now() WHERE `Reference_id`='$send_RP_ID' AND `item_id`='$send_product_id'";
        $query = mysqli_query($conn, $UPDATE);

        if($query){
            $_SESSION['payment_status'] = "Order Payment Successfully!";
            header('Location: payment_check.php');
            exit();
        }
    }

?>