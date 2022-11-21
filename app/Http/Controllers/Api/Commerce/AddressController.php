<?php

namespace App\Http\Controllers\Api\commerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Resources\AddressRessource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {     
        $listAddress= Address::where('user_id', Auth::id())->get();
//dd($listAddress);
        return AddressRessource::collection($listAddress);

        // return response()->json([
        //     'addresses'=>$listAddress
        // ], 200); 
    }

    public function store(StoreAddressRequest $request)
    {
        $data = $request->validated();
        $data['user_id']= Auth::id();
       
        $address = Address::create($data);

        return response()->json([
            'address'=>$address
        ], 200); 
    }
}
