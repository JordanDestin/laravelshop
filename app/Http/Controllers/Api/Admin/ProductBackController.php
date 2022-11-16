<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductRessource;
use App\Models\Product;

class ProductBackController extends Controller
{
    public function index()
    {

        
        $products= Product::with('category')
        ->when(request('category'), function($query){
            $query->where('category_id',request('category'));
        })
        ->paginate(30);


        return ProductRessource::collection($products);

    }

    public function store(Product $product)
    {

    }

    public function destroy(Product $product)
    {

    }
}
