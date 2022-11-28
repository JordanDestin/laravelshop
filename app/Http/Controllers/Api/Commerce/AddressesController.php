<?php
//http://laravelshop.test
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

        return AddressRessource::collection($listAddress);
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
        $data['delivery'] = $request->has('active');
        $data['user_id']= Auth::id();
      
        $address = Address::create($data);

        return new AddressRessource($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $address = Address::where('id', $id)->first();
        return new AddressRessource($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAddressRequest $request, $id)
    {
        $data = $request->validated();
        $data['delivery'] = $request->has('active');
        $address = Address::where('id', $id)->first();
        $address->update($data);

        return new AddressRessource($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $address = Address::where('id', $id)->first();
        $address->delete();

        return response()->noContent();
    }
}
