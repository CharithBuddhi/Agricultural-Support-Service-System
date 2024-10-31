<?php
    session_start();
// if(!isset($_SESSION['login_id']) && !isset($_SESSION['login_user']) && !isset($_SESSION['login_type'])){
//     header('Location: login.php');
//     exit();
// }
date_default_timezone_set('Asia/Colombo');
use Stripe\Exception\ApiErrorException;

// set session variable 
$product_id = $_SESSION['agro_id'];
$product_category = $_SESSION['agro_category'];
$agro_type = $_SESSION['agro_type'];
$product_name = $_SESSION['agro_name'];
$product_price = $_SESSION['agro_price'];
$product_quantity = $_SESSION['agro_quantity'];
$shop_name = $_SESSION['shop_name'] ;
$agro_location = $_SESSION['agro_location'];
$quantity = $_SESSION['order_quantity'];
$total_price = $_SESSION['total_price'];
$half_price = $_SESSION['half_price'];
$product_currency = $_SESSION['agro_currency'];
$provider_id = $_SESSION['provider_id'];
$provider_name = $_SESSION['provider_name'];
$provider_phone = $_SESSION['provider_phone'];
$provider_email = $_SESSION['provider_email'];

// script API key configaration
define("STRIPE_API_KEY", "sk_test_51QEPjARxjCPZ5J0VC4cI1kRBJxWrnywFuSbgi4eN5WRF6GrGblP6RrOD24VRIjRSrOCik9LTT6WUXFvGrp7UOldx00DAGfDisH");
define("STRIPE_PUBLISHABLE_KEY", "pk_test_51QEPjARxjCPZ5J0VljXbUGrY0NuzDKvFyrUvZkcFNpND9W1c94R1NUEZgkWLsTloAKXtSGBDJvS6oln1PnrVXyNJ00USpCJ7sH");
define("STRIPE_SUCCESS_URL", "http://localhost/Agricultural-Support-Service-System/MyAgro/end/success.php");
define("STRIPE_CANCEL_URL", "http://localhost/Agricultural-Support-Service-System/MyAgro/end/cancel.php");

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

        // Payment Information
        $payment_id = $transaction['Reference_id'];
        $transaction_id = $transaction['txn_id'];
        $total_price = $transaction['total_amount'];
        $paid_amount = $transaction['paid_amount'];
        $payment_status = $transaction['payment_status'];
        $created_at = $transaction['created'];

        // Product Information
        $product_category = ucfirst($transaction['item_category']);
        $product_name = ucfirst($transaction['item_name']);
        $product_price = $transaction['item_price'];
        $product_quantity = $transaction['item_quantity'];
        $quantity = $transaction['order_quantity'];
        $agro_location = $transaction['item_location'];

        // Customer Information
        $customer_name = $transaction['customer_name'];
        $customer_email = $transaction['customer_email'];
        
        // Provider Information
        $provider_name = $transaction['provider_name'];
        $provider_phone = $transaction['provider_phone'];
        $provider_email = $transaction['provider_email'];

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
            // $customer_details = $checkout_session->customer_details;
            $customer_id = $_SESSION['login_id'];
            $user_type = $_SESSION['login_type'];

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
                    $paid_amount = ($paid_amount/ 100);
                    $paid_currency = $payment_intent->currency;
                    $payment_status = $payment_intent->status;

                    // Customer details
                    if($user_type == 'customer') {
                        
                        $sql = "SELECT customer_name,customer_email FROM customer WHERE customer_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('i', $customer_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if($result->num_rows > 0) {

                            $customer_details = $result->fetch_assoc();

                            $customer_name = $customer_details['customer_name'];
                            $customer_email = $customer_details['customer_email'];
                           
                        }else{
                            
                            // header('Location: cancel.php');
                            // exit();   
                        }


                    } else if($user_type == 'supplier') {

                        $sql = "SELECT supplier_name,supplier_email FROM supplier WHERE supplier_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('s', $customer_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if($result->num_rows > 0) {

                            $customer_details = $result->fetch_assoc();

                            $customer_name = $customer_details['supplier_name'];
                            $customer_email = $customer_details['supplier_email'];
                           
                        }else{
                            
                            // header('Location: cancel.php');
                            // exit();   
                        }

                    }else if($user_type == 'farmer') {

                        $sql = "SELECT farmer_name,farmer_email FROM farmer WHERE farmer_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('s', $customer_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if($result->num_rows > 0) {

                            $customer_details = $result->fetch_assoc();

                            $customer_name = $customer_details['farmer_name'];
                            $customer_email = $customer_details['farmer_email'];
                           
                        }else{
                            
                            // header('Location: cancel.php');
                            // exit();   
                        }
                        
                    }

                    //check any transaction already exsist with same txn_id
                    $sqlQ = "SELECT Reference_id FROM transaction WHERE txn_id = ?";
                    $stmt = $conn->prepare($sqlQ);  
                    $stmt->bind_param('s', $transaction_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $prevRow = $result->fetch_assoc();

                    if(!empty($prevRow)) {
                        $payment_id = $prevRow['Reference_id ']; 

                    }else{

                        $created_at = date("Y-m-d H:i:s");
                        $sql = "INSERT INTO transaction (customer_id, customer_name, customer_email, provider_id, provider_name, provider_phone, provider_email, item_category, item_name, item_id, item_price, item_quantity, item_location, order_quantity, paid_amount, total_amount, paid_currency, txn_id, payment_status, stripe_id, created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ississsssiddsdddssss", $customer_id, $customer_name, $customer_email, $provider_id, $provider_name, $provider_phone, $provider_email, $product_category, $product_name, $product_id, $product_price, $product_quantity, $agro_location, $quantity, $paid_amount, $total_price, $paid_currency, $transaction_id, $payment_status, $session_id );
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

        <div class="flex flex-col items-center w-2/3 p-5 mt-1 border shadow-2xl bg-slate-100 rounded-3xl">

        <?php if(!empty($payment_id)) { ?>
 
            <h1 class="p-5 font-serif text-3xl font-bold text-center text-green-500">MyAgro</h1>

            <h3 class="text-lg font-medium text-gray-500">Online Payment</h3>

            <div class="flex w-full gap-2 mt-2  bg-[#d7fac7] p-3 rounded-lg">
                <img src="images/success.JPG" alt="" class="w-7 h-7">
                <h1 class="text-[#46d82f] font-semibold"><?php echo $statusMsg; ?></h1>
            </div>

            <!-- Payment Information -->
            <div class="flex flex-col w-full gap-2 p-2 mt-3 border-2 rounded-xl">
                <h4 class="text-lg font-bold text-[#46d82f]">Payment Information</h4>
                <p class="flex justify-between"><b>Reference Number</b><?php echo $payment_id; ?> </p>
                <p class="flex justify-between"><b>Transaction ID</b><label class="pl-6"><?php echo $transaction_id; ?></label> </p>
                <p class="flex justify-between"><b>Total Amount</b> <?php echo "Rs. ".$total_price; ?></p>
                <p class="flex justify-between"><b>Paid Amount</b><?php echo "Rs. ".$paid_amount; ?></p>
                <p class="flex justify-between"><b>Payment Status</b> <?php echo ucfirst($payment_status); ?></p>
                <p class="flex justify-between"><b>Date & Time</b> <?php echo $created_at; ?></p>
            </div>

            <!-- Product Information -->
            <div class="flex flex-col w-full gap-2 p-2 mt-3 border-2 rounded-xl">
                <h4 class="text-lg font-bold text-[#46d82f]">Product Information</h4>
                <p class="flex justify-between"><b>Product Category</b> <?php echo $product_category; ?> </p>
                <p class="flex justify-between"><b>Product Name</b> <label class="pl-6"><?php echo $product_name; ?></label></p>
                <p class="flex justify-between"><b>Product Price</b> <?php echo "Rs. ".$product_price; ?></p>
                <p class="flex justify-between"><b>Product Quantity</b> <?php echo $product_quantity." Kg"; ?> </p>
                <p class="flex justify-between"><b>Purchased Quantity</b> <?php echo $quantity." Kg"; ?> </p>
                <p class="flex justify-between"><b>Purchased Location</b><label class="pl-6"><?php echo $agro_location; ?></label></p>
            </div>

            <!-- Customer  Information -->
            <div class="flex flex-col w-full gap-2 p-2 mt-3 border-2 rounded-xl">
                <h4 class="text-lg font-bold text-[#46d82f]">Customer Information</h4>
                <p class="flex justify-between"><b class="mr-2">Customer Name</b> <label class="pl-6"><?php echo ucfirst($customer_name); ?></label></p>
                <p class="flex justify-between"><b>Customer Email</b><?php echo $customer_email; ?></p>
            </div>

            <!-- Provider Information -->
            <div class="flex flex-col w-full gap-2 p-2 mt-3 border-2 rounded-xl">
                <h4 class="text-lg font-bold text-[#46d82f]">Provider Information</h4>
                <p class="flex justify-between"><b>Provider Name</b> <?php echo ucfirst($provider_name); ?> </p>
                <p class="flex justify-between"><b>Provider Phone</b> <?php echo "+".$provider_phone; ?> </p>
                <p class="flex justify-between"><b>Provider Email</b> <?php echo $provider_email; ?> </p>
            </div>

        <?php 
            $_SESSION['paySuccess'] = true;
        }else{ ?>

            <h1 class="text-2xl font-bold text-center text-red-500">Your Payment has been failed</h1>
            <p class="text-lg font-bold text-center text-red-500">Please try again! </p>

        <?php } ?>

            <a id="back_btn" style="display: block;" href="agrosell.php?type=<?php echo $_SESSION['agro_type']; ?>" class="px-4 py-2 mt-5 font-bold text-white rounded bg-lime-500 hover:bg-[#55fd3b]">Back to Product Page</a>
    
        </div>

    </div>

    <?php 

    // Download PDF function disaply and hide  

    if(isset($_SESSION['paySuccess'])){
        unset($_SESSION['paySuccess']);
    ?>

        <div class="absolute top-4 right-4 w-fit">
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