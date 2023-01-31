<?php

namespace App\Http\Controllers\Api\Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Address;
use Cart;
use Illuminate\Support\Str;

class StripeCheckoutController extends Controller
{
    public function paymentIntent($id)
    {  

        $address_order = Address::where('id', $id)->first();

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
                'total_order' => $cartTotal
            ]);

            $order->adresses()->create($address_order->toArray());

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

}
