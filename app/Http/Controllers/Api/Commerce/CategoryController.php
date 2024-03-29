<?php

namespace App\Http\Controllers\Api\commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        return CategoryResource::collection($category);
    }

    public function store (Request $request)
    {

    }
}
