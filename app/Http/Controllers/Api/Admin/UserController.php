<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return UserResource::collection($user);
       
    }

    public function show($id)
    {
        $userOrder = Order::where('id',$id)
            ->get();

        return response()->json([
            'userOrders'=>$userOrder
        ], 200); 
    }
}
