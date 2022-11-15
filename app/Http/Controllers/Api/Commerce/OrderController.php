<?php

namespace App\Http\Controllers\Api\Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Cart;

class OrderController extends Controller
{
    public function index()
    {
        $listOrders= auth()->user()->orders;

       

        // $listOrders =  DB::table('orders')
        //     ->leftjoin('order_product','order_product.order_id','=','orders.id')
        //     ->join('products','products.id','=','order_product.product_id')
        //     ->where('orders.user_id',Auth::id())
        //     ->get();

        return response()->json([
            'orders'=>$listOrders
        ], 200); 

    }

    public function store(Request $request)
    {   
        $order = auth()->user->orders()->create([
            'order_number' =>uniqid()
        ]);

        $cartContent = Cart::getContent()
            ->each(function($product)use($order){
                $order->producs()->attach($product->id, [
                    'total_price' => $product->price * $product->quantity,
                    'total_quantity' => $product->quantity,
                ]);
            });

            Cart::clear();    
            
        return response()->json(200);

    }

    public function detailOrder($id)
    {
        $order =  DB::table('orders')
            ->leftjoin('order_product','order_product.order_id','=','orders.id')
            ->join('products','products.id','=','order_product.product_id')
            ->where('orders.id',$id)
            ->get();

        return response()->json([
            'order'=>$order
        ], 200); 
    }
}
