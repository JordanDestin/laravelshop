<?php

namespace App\Http\Controllers\Api\Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Resources\AddressRessource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Address;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listAddress= Address::where('user_id', Auth::id())->get();
//dd($listAddress);
        return AddressRessource::collection($listAddress);

        // return response()->json([
        //     'addresses'=>$listAddress
        // ], 200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $data = $request->validated();
        $data['user_id']= Auth::id();
       
        $address = Address::create($data);

        return response()->json([
            'address'=>$address
        ], 200); 
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
        //
    }
}
