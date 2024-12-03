<?php 
session_start();

// script API key configaration
define("STRIPE_API_KEY", "sk_test_51QEPjARxjCPZ5J0VC4cI1kRBJxWrnywFuSbgi4eN5WRF6GrGblP6RrOD24VRIjRSrOCik9LTT6WUXFvGrp7UOldx00DAGfDisH");
define("STRIPE_PUBLISHABLE_KEY", "pk_test_51QEPjARxjCPZ5J0VljXbUGrY0NuzDKvFyrUvZkcFNpND9W1c94R1NUEZgkWLsTloAKXtSGBDJvS6oln1PnrVXyNJ00USpCJ7sH");
define("STRIPE_SUCCESS_URL", "http://localhost/Agricultural-Support-Service-System/MyAgro/end/success.php");
define("STRIPE_CANCEL_URL", "http://localhost/Agricultural-Support-Service-System/MyAgro/end/productSell.php");


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
    $product_id = $request->vegfruitle_id;
    $product_category = $request->vegetable_category;
    $vegfruitle_verity = $request->vegfruitle_verity;

    $product_name = $request->vegetable_name;
    $product_price = $request->vegfruit_price;
    $product_quantity = 0.25;
    $product_currency = "LKR";

    $vegfruit_location = $request->vegfruit_location;
    $order_quantity = $request->order_quantity;
    $total_price = $request->total_price;

    // $order_quantity = str_replace("Kg", "", $order_quantity);

    $order_quantity_convert = floatval($order_quantity);

    $provider_id = $request->provider_id;
    $provider_name = $request->provider_name;
    $provider_phone = $request->provider_phone;
    $provider_email = $request->provider_email;

    // set session variable 
    $_SESSION['vegfruitle_id'] = $product_id;
    $_SESSION['agro_category'] = $product_category;
    $_SESSION['vegfruitle_verity'] = $vegfruitle_verity;
    $_SESSION['vegetable_name'] = $product_name;
    $_SESSION['vegfruit_price'] = $product_price;
    $_SESSION['vegetable_currency'] = $product_currency;
    $_SESSION['vegfruit_location'] = $vegfruit_location;
    $_SESSION['order_quantity'] = $order_quantity_convert;
    $_SESSION['total_price'] = $total_price;
    $_SESSION['meassure'] = "Kg";
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

        
        $amount = round((($product_price/4) * 100),2);
        $order_packet_amount = $order_quantity_convert / $product_quantity;
        
        // echo $vegfruitle_verity;
        try {

            // Create a checkout session using the price object
            $checkout_session = \Stripe\Checkout\Session::create([
                "mode" => "payment",
                "success_url" => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}',
                "cancel_url" => STRIPE_CANCEL_URL.'?qun='.$order_quantity_convert.'&id='.$product_id,
                "locale" => "auto",
                "line_items" => [
                    [
                        "quantity" => $order_packet_amount,
                        "price_data" => [
                            "currency" => $product_currency,
                            "unit_amount" => $amount,
                            "product_data" => [
                                "name" => $vegfruitle_verity,
                                "description" => $vegfruitle_verity." is the type of ".$product_name." ".$product_category,
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