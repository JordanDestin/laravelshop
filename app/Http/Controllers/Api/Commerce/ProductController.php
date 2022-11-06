<?php

namespace App\Http\Controllers\Api\Commerce;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products= Product::whereActive(true)
            ->take(16)
            ->get();


        return response()->json([
            'listproducts'=>$products
        ], 200); 
    }
}
