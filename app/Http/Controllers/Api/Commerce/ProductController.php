<?php

namespace App\Http\Controllers\Api\Commerce;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductRessource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products= Product::with('category')
            ->whereActive(true)
            ->when(request('category'), function($query){
                $query->where('category_id',request('category'));
            })
            ->paginate(20);

        $productTendance = Product::where('tendance', 1)->get();

     return ProductRessource::collection($products,$productTendance);

    }

    public function productTendance()
    {
        $productTendance = Product::where('tendance', 1)->get();

        return response()->json([
            'productsTendance' => $productTendance
        ], 200); 
    }
}
