<?php

namespace App\Http\Controllers\Api\Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\CartRepository;
use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartContent = Cart::getContent();
        $cartTotal = Cart::getTotal();
        $count = Cart::getContent()->sum('quantity');

        return response()->json([
            'cartContent' => $cartContent,
            'totalCart' => $cartTotal,
            'count' => $count           
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->id);
        $product = Product::where('id', $request->id)->first();
     
         Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => 1,
            'attributes' => [],
            'associatedModel' => $product
          ]
        );

        $count = Cart::getContent()->sum('quantity');
      //  dd($count);
       // return response()->json(200);
         return response()->json([
             'count' => $count
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // (new CartRepository())->remove($id);
       Cart::remove($id);
       return response()->json(200);
    }

    public function count()
    {
        // $count = (new CartRepository())->count();

        $count = Cart::getContent()->sum('quantity');

        return response()->json([
            'count' => $count
        ]);
    }

    public function increase($id)
    {
       Cart::update($id, [
                'quantity' => +1
            ]);
    }

    public function decrease($id)
    {
        Cart::update($id, [
            'quantity' => -1
        ]);
    }

    public function cartTotal()
    {
        $cartTotal = Cart::getTotal();

        return response()->json([
            'cartTotal' => $cartTotal
        ]);
    }

    public function removeCart()
    {
        // (new CartRepository())->removeCart();

        Cart::clear();
        return response()->json(200);
    }

}
