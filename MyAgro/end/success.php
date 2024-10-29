<?php
date_default_timezone_set('Asia/Colombo');
use Stripe\Exception\ApiErrorException;

session_start();

require_once('transaction.php');
require_once('db_connect.php');

$payment_id = $statusMsg = '';
$status = 'error';

if(!empty($_GET['session_id'])) {

    $session_id = $_GET['session_id'];

    // fetch transaction data from the database already exsist
    $sql = "SELECT * FROM transaction WHERE stripe_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $session_id);
    $db_stripe_id = $session_id;
    $stmt->execute();
    $result = $stmt->get_result();

    if($result -> num_rows > 0) {
        $transaction = $result->fetch_assoc();
        $payment_id = $transaction['transaction_id'];
        $transaction_id = $transaction['txn_id'];
        $paid_amount = $transaction['paid_amount'];
        $paid_currency = $transaction['paid_currency'];
        $payment_status = $transaction['payment_status'];

        $customer_name = $transaction['customer_name'];
        $customer_email = $transaction['customer_email'];

        // $payment_id = $transaction['transaction_id'];
        // $payment_id = $transaction['transaction_id'];
        // $payment_id = $transaction['transaction_id'];

        $status = 'success';
        $statusMsg = 'Your payment was successful.';

    }else{
        //Include the Stripe PHP library
        // require_once('stripe-php/init.php');
        require __DIR__ . "/vendor/autoload.php";

        $stripe_secret_key = STRIPE_API_KEY;
        \Stripe\Stripe::setApiKey($stripe_secret_key);

        // Fetch the Checkout session to display the JSON result on the success page

        try{
            $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);

        }catch(Exception $e){
            $api_error = $e->getMessage();
        }
        
        if(empty($api_error) && $checkout_session) {

            // Get customer details
            $customer_details = $checkout_session->customer_details;

            // Retrieve the payment intent
            try{
                $payment_intent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
            }catch(ApiErrorException $e){
                $api_error = $e->getMessage();
            }

            if(empty($api_error) && $payment_intent) {

                if(!empty($payment_intent) && $payment_intent->status === 'succeeded') {
                    //Transaction details
                    $transaction_id = $payment_intent->id;
                    $paid_amount = $payment_intent->amount;
                    $paid_amount = ( $paid_amount/ 100);
                    $paid_currency = $payment_intent->currency;
                    $payment_status = $payment_intent->status;

                    // Customer details
                    $customer_name = $customer_email = '';
                    if(!empty($customer_details)) {
                        $customer_name = !empty($customer_details->name) ? $customer_details->name : '';
                        $customer_email = !empty($customer_details->email) ? $customer_details->email : '';
                
                    }

                    //check any transaction already exsist with same txn_id
                    $sqlQ = "SELECT transaction_id FROM transaction WHERE txn_id = ?";
                    $stmt = $conn->prepare($sqlQ);  
                    $stmt->bind_param('s', $transaction_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $prevRow = $result->fetch_assoc();

                    if(!empty($prevRow)) {
                        $payment_id = $prevRow['transaction_id']; 

                    }else{

                        $sql = "INSERT INTO transaction (customer_name, customer_email, provider_id, provider_name, provider_phone, provider_address, item_name, item_id, item_price, item_price_currency, paid_amount, paid_currency, txn_id, payment_status, stripe_id, created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssissssidsdssss",$customer_name, $customer_email, $provider_id, $provider_name, $provider_phone, $provider_address, $product_name, $product_id, $product_price, $product_currency, $paid_amount, $paid_currency, $transaction_id, $payment_status, $session_id );
                        $insert = $stmt->execute();

                        if($insert){
                            $payment_id = $stmt -> insert_id;
                        }

                    }

                    $status = 'Success';
                    $statusMsg = 'Your Payment has been successfully completed.';

                }else{

                    $statusMsg = 'Payment failed. Please try again.';
                }
                

            }else{
                $statusMsg = "Unable to fetch the transaction details. Please try again. $api_error";
            }
                
        }else{
            $statusMsg = "Invalid Transaction. Please try again. $api_error";
        }
        
    }

}else{
    $statusMsg = 'Transaction Invalid. Please try again.';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Stripe Example</title>
    <meta charset="UTF-8" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="javascript/script.js"></script>
    <!-- pdf convert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.js"></script>
    
</head>
<body>
    <div id="invoice" class="flex items-center justify-center h-full">

        <div class="flex flex-col items-center p-5 mt-6 border shadow-2xl bg-slate-100 w-fit rounded-3xl">

        <?php if(!empty($payment_id)) { ?>
 
            <h1 class="p-5 font-serif text-3xl font-bold text-center text-green-500">MyAgro</h1>

            <h3 class="text-lg font-medium text-gray-500">Online Payment</h3>

            <div class="flex w-full gap-2 mt-2 text-center bg-[#d7fac7] p-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="2.3" stroke="currentColor" class="size-6 text-[#46d82f] font-semibold">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                </svg>
                <h1 class="text-[#46d82f] flex self-center text-center font-semibold"><?php echo $statusMsg; ?></h1>
            </div>

            <div class="flex flex-col w-full gap-2 p-2 mt-3 border-2 rounded-xl">
                <h4 class="text-lg font-bold text-[#46d82f]">Payment Information</h4>
                <p class="flex justify-between"><b>Reference Number</b><?php echo $payment_id; ?> </p>
                <p class="flex justify-between"><b>Transaction ID</b><label class="pl-6"><?php echo $transaction_id; ?></label> </p>
                <p class="flex justify-between"><b>Paid Amount</b> <?php echo $paid_amount; ?> <?php echo $paid_currency; ?> </p>
                <p class="flex justify-between"><b>Payment Status</b> <?php echo $payment_status; ?></p>
                <p class="flex justify-between"><b>Date & Time</b> <?php echo date("Y-m-d H:i:s"); ?></p>
            </div>

            <div class="flex flex-col w-full gap-2 p-2 mt-3 border-2 rounded-xl">
                <h4 class="text-lg font-bold text-[#46d82f]">Product Information</h4>
                <p class="flex justify-between"><b>Product Category</b> <?php echo $product_category; ?> </p>
                <p class="flex justify-between"><b>Product Name</b> <label class="pl-6"><?php echo $product_name; ?></label></p>
                <p class="flex justify-between"><b>Product Price</b> <?php echo $product_price; ?> <?php echo $product_currency; ?> </p>
            </div>

            <div class="flex flex-col w-full gap-2 p-2 mt-3 border-2 rounded-xl">
                <h4 class="text-lg font-bold text-[#46d82f]">Customer Information</h4>
                <p class="flex justify-between"><b class="mr-2">Customer Name</b> <label class="pl-6"><?php echo $customer_name; ?></label></p>
                <p class="flex justify-between"><b>Customer Email</b><?php echo $customer_email; ?></p>
            </div>

            <div class="flex flex-col w-full gap-2 p-2 mt-3 border-2 rounded-xl">
                <h4 class="text-lg font-bold text-[#46d82f]">Provider Information</h4>
                <p class="flex justify-between"><b>Provider Name</b> <?php echo $provider_name; ?> </p>
                <p class="flex justify-between"><b>Provider Phone</b> <?php echo $provider_phone; ?> </p>
                <p class="flex justify-between"><b>Provider Address</b><label class="pl-6"><?php echo $provider_address; ?></label></p>
            </div>

        <?php 
            $_SESSION['paySuccess'] = true;
        }else{ ?>

            <h1 class="text-2xl font-bold text-center text-red-500">Your Payment has been failed</h1>
            <p class="text-lg font-bold text-center text-red-500">Please try again! </p>

        <?php } ?>

            <a id="back_btn" style="display: block;" href="index.php" class="px-4 py-2 mt-5 font-bold text-white rounded bg-lime-500 hover:bg-[#55fd3b]">Back to Product Page</a>
    
        </div>

    </div>

    <?php 

    // Download PDF function disaply and hide  

    if(isset($_SESSION['paySuccess'])){
        unset($_SESSION['paySuccess']);
    ?>

        <div class="absolute top-6 right-8 w-fit">
            <button id="download" class="flex gap-2 px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                Download PDF
            </button>
        </div>
        
    <?php } ?>

    

</body>
</html>