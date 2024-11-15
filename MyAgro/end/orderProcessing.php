<?php 
session_start();

// script API key configaration
define("STRIPE_API_KEY", "sk_test_51QEPjARxjCPZ5J0VC4cI1kRBJxWrnywFuSbgi4eN5WRF6GrGblP6RrOD24VRIjRSrOCik9LTT6WUXFvGrp7UOldx00DAGfDisH");
define("STRIPE_PUBLISHABLE_KEY", "pk_test_51QEPjARxjCPZ5J0VljXbUGrY0NuzDKvFyrUvZkcFNpND9W1c94R1NUEZgkWLsTloAKXtSGBDJvS6oln1PnrVXyNJ00USpCJ7sH");
define("STRIPE_SUCCESS_URL", "http://localhost/Agricultural-Support-Service-System/MyAgro/end/success.php");

if($_SESSION['category'] == "chemical"){
    define("STRIPE_CANCEL_URL", "http://localhost/Agricultural-Support-Service-System/MyAgro/end/chemicalsell.php");
}elseif($_SESSION['category'] == "fertilizer"){
    define("STRIPE_CANCEL_URL", "http://localhost/Agricultural-Support-Service-System/MyAgro/end/agrosell.php");
}

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = STRIPE_API_KEY;
\Stripe\Stripe::setApiKey($stripe_secret_key);

// Default response
$response = array(
    'status' => 0,
    'error' => array(
        'message' => 'Invalid Request'
    )
);

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = file_get_contents("php://input");
    $request = json_decode($input);

    //product dtails
    $product_id = $request->agro_id;
    $product_category = $request->agro_category;
    $agro_type = $request->agro_type;
    
    $product_name = $request->agro_name;
    $product_price = $request->agro_price;
    $product_quantity = $request->agro_quantity;
    $product_currency = "LKR";
    
    $shop_name = $request->shop_name;
    $agro_location = $request->agro_location;
    $order_quantity = $request->order_quantity;

    $total_price = $request->total_price;
    // $half_price = $request->half_price;

    $provider_id = $request->provider_id;
    $provider_name = $request->provider_name;
    $provider_phone = $request->provider_phone;
    $provider_email = $request->provider_email;
    
    // set session variable 
    $_SESSION['agro_id'] = $product_id;
    $_SESSION['agro_category'] = $product_category;
    $_SESSION['agro_type'] = $agro_type;
    $_SESSION['agro_name'] = $product_name;
    $_SESSION['agro_price'] = $product_price;
    $_SESSION['agro_quantity'] = $product_quantity;
    $_SESSION['shop_name'] = $shop_name;
    $_SESSION['agro_location'] = $agro_location;
    $_SESSION['order_quantity'] = $order_quantity;
    $_SESSION['total_price'] = $total_price;
    // $_SESSION['half_price'] = $half_price;
    $_SESSION['agro_currency'] = $product_currency;
    $_SESSION['provider_id'] = $provider_id;
    $_SESSION['provider_name'] = $provider_name;
    $_SESSION['provider_phone'] = $provider_phone;
    $_SESSION['provider_email'] = $provider_email;

    if(json_last_error() !== JSON_ERROR_NONE) {
        $response['error']['message'] = 'JSON decode error';
        echo json_encode($response);
        exit;
    }

    // Check if `createCheckoutSession` is set
    if(!empty($request->createCheckoutSession)) {

        $amount = round(($product_price * 100),2);
        $order_packet_amount = ($order_quantity/$product_quantity);

        try {

            // Create a checkout session using the price object
            $checkout_session = \Stripe\Checkout\Session::create([
                "mode" => "payment",
                "success_url" => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}',
                "cancel_url" => STRIPE_CANCEL_URL.'?type='.$agro_type,
                "locale" => "auto",
                "line_items" => [
                    [
                        "quantity" => $order_packet_amount,
                        "price_data" => [
                            "currency" => $product_currency,
                            "unit_amount" => $amount,
                            "product_data" => [
                                "name" => $product_name,
                                "description" => $product_name." is the type of ".$agro_type." ".$product_category,
                            ]
                        ]
                        
                    ]
                ]
            ]);

            $response = array(
                'status' => 200,
                'message' => 'Checkout Session Created Successfully.',
                'session_id' => $checkout_session->id
            );
        } catch (Exception $e) {
            $response['error']['message'] = 'Checkout session creation failed: ' . $e->getMessage();
        }
    } else {
        $response['error']['message'] = 'Checkout session not initiated.';
    }
}

echo json_encode($response);

?>