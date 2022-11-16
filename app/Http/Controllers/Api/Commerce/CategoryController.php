<?php

namespace App\Http\Controllers\Api\commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        return response()->json([
            'listcategory'=>$category
        ], 200); 
    }

    public function store (Request $request)
    {
        
    }
}
