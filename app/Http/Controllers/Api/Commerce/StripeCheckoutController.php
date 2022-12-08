<?php

namespace App\Http\Controllers\Api\Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Cart;
use Illuminate\Support\Arr;

class StripeCheckoutController extends Controller
{
    public function paymentIntent($id)
    {       
        // This is your test secret API key.
        \Stripe\Stripe::setApiKey(\config('stripe.test_secret_key'));

        $cartTotal = Cart::getTotal();

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $cartTotal,
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            
            $order = auth()->user()->orders()->create([
                'order_number' => uniqid(),
                'total_order' => $cartTotal,
                //'address_id' => 
            ]);

            $cartContent = Cart::getContent()
                ->each(function($product)use($order){
                    $order->products()->attach($product->id, [
                        'total_price' => $product->price * $product->quantity,
                        'total_quantity' => $product->quantity,
                    ]);
                });
    
               Cart::clear();  

            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function checkoutTest()
    {
     

        \Stripe\Stripe::setApiKey(\config('stripe.test_secret_key'));

        $cartContent = Cart::getContent();
        

        //dd($cartContent);

        $lineItems = [];

        foreach($cartContent as $item) {
        // $quantity = 
            //dd($item);
            $quantity = $item->quantity;
            $lineItems = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->name,
        //                        'images' => [$product->image]
                    ],
                    'unit_amount' => $item->price * 100,
                ],
                'quantity' => $quantity,
            ];
        }

 dd($lineItems);

// $lineItems = array_map(fn(array $product) => [
//     'quantity' =>$product['quantity'],
//     'price_data' => [
//         'currency' => 'EUR',
//         'product_data' => [
//             'name' => $product['name'],

//         ],
//         'unit_amount' => $product->price * 100,
//     ]
// ],$cartContent );

// dd($lineItems);


 
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $cartContent,
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/thank-you',
            'cancel_url' => 'http://localhost:8000/cancel-stripe',
        ]);

        return redirect($session->url);
    }
}
