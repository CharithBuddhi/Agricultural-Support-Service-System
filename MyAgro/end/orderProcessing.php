<?php 
session_start();
require_once('transaction.php');
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

    if(json_last_error() !== JSON_ERROR_NONE) {
        $response['error']['message'] = 'JSON decode error';
        echo json_encode($response);
        exit;
    }

    // Check if `createCheckoutSession` is set
    if(!empty($request->createCheckoutSession)) {
        $amount = round($product_price * 100);

        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                "mode" => "payment",
                "success_url" => STRIPE_SUCCESS_URL . '?session_id={CHECKOUT_SESSION_ID}',
                "cancel_url" => STRIPE_CANCEL_URL,
                "locale" => "auto",
                "line_items" => [
                    [
                        "quantity" => 1,
                        "price_data" => [
                            "currency" => $product_currency,
                            "unit_amount" => $amount,
                            "product_data" => [
                                "name" => $product_name,
                                "metadata" => ["pro_id" => $product_id]
                            ]
                        ]
                    ]
                ]
            ]);

            $response = array(
                'status' => 200,
                'message' => 'Checkout Session created successfully.',
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


    // $checkout_session = \Stripe\Checkout\Session::create([
    //     "mode" => "payment",
    //     "success_url" => "http://localhost/Agricultural-Support-Service-System/MyAgro/end/success.php",
    //     "cancel_url" => "http://localhost/Agricultural-Support-Service-System/MyAgro/end/paymentType.php",
    //     "locale" => "auto",
    //     "line_items" => [
    //         [
    //             "quantity" => $_POST["quantity"]/2,
    //             "price_data" => [
    //                 "currency" => "usd",
    //                 "unit_amount" => $amount,
    //                 "product_data" => [
    //                     "name" => $_POST['agro_name']
    //                 ]
    //             ]
    //         ]
    //     ]
    // ]);

    // http_response_code(303);
    // header("Location: " . $checkout_session->url);

?>