<?php 
ob_start();
// Initialize shopping cart class 
include_once ('/home/desarsgr/public_html/php/cartAction.php'); 
$cart = new Cart;

// Include configuration file   
require_once ('/home/desarsgr/public_html/php/config.php');
 
// Include Stripe PHP library  
require_once 'init.php';

$cartItems = $cart->contents(); 
foreach($cartItems as $item)
{
  $cart_total +=  $item['subtotal'];
}

include_once ('/home/desarsgr/public_html/php/addressAction.php'); 
$address1 = new Address;

$addressDetails = $address1->contents(); 

// $subTotal = round($cart_total*100, 2);
$tax = round(($cart_total * .0855), 2);
$stripeAmount = round(($cart_total + $tax) * 100,2); 
// Set API key 
\Stripe\Stripe::setApiKey(STRIPE_API_KEY);
\Stripe\Stripe::setVerifySslCerts(true);
\Stripe\Stripe::setCABundlePath('/etc/ssl/certs/ca-bundle.crt');
 
$response = array( 
    'status' => 0, 
    'error' => array( 
        'message' => 'Invalid Request!'    
    ) 
); 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $input = file_get_contents('php://input'); 
    $request = json_decode($input);     
} 
 
if (json_last_error() !== JSON_ERROR_NONE) { 
    http_response_code(400); 
    echo json_encode($response); 
    exit; 
} 
 
if(!empty($request->checkoutSession)){ 
    // Create new Checkout Session for the order 
    try { 
        $session = \Stripe\Checkout\Session::create([ 
            'payment_method_types' => ['card'],
            'customer_email' => $addressDetails['email'],
            'billing_address_collection' => 'auto',
            'line_items' => [[ 
                'price_data' => [ 
                    'product_data' => [ 
                        'name' => 'Desar\'s Green hands', 
                        'metadata' => [ 
                            'pro_id' => 'AD111' 
                        ] 
                    ], 
                    'unit_amount' => $stripeAmount, 
                    'currency' => 'usd', 
                ], 
                'quantity' => 1, 
                'description' => 'Desar\'s Green Hands Landscaping Services', 
            ]], 
            'mode' => 'payment', 
            'success_url' => STRIPE_SUCESS_URL, 
            'cancel_url' => STRIPE_CANCEL_URL,

        ]); 
    }catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    if(empty($api_error) && $session){ 
        $response = array( 
            'status' => 1, 
            'message' => 'Checkout Session created successfully!', 
            'sessionId' => $session['id'] 
        ); 
    }else{ 
        $response = array( 
            'status' => 0, 
            'error' => array( 
                'message' => 'Checkout Session creation failed! '.$api_error    
            ) 
        ); 
    } 
} 
 
// Return response 
echo json_encode($response);