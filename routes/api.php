<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Commerce\ProductController;
use App\Http\Controllers\Api\Commerce\CategoryController;
use App\Http\Controllers\Api\Commerce\CartController;
use App\Http\Controllers\Api\Commerce\StripeCheckoutController;
use App\Http\Controllers\Api\Commerce\OrderController;
use App\Http\Controllers\Api\Commerce\AddressController;

use App\Http\Controllers\Api\Commerce\AddressesController;

use App\Http\Controllers\Api\Admin\ProductBackController;
use App\Http\Controllers\Api\Admin\UserBackController;

use App\Models\Product;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['middleware' =>['auth:sanctum']], function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    }) ; 
     Route::post('paymentIntent/{id}',[StripeCheckoutController::class,'paymentIntent']);
    // Route::post('paymentIntent',[StripeCheckoutController::class,'paymentIntent']);
     Route::get('orders',[OrderController::class,'index'])->name('orders.index');
     Route::post('orders',[OrderController::class,'store'])->name('orders.store');
     Route::get('order/{id}',[OrderController::class,'detailOrder'])->name('order.detailOrder');
     Route::apiResource('adresses', AddressesController::class);
     Route::apiResource('user', UserController::class);

     Route::post('checkouttest',[StripeCheckoutController::class,'checkoutTest']);
   
});


//ADMIN
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('admin-products', ProductBackController::class);
     
    Route::get('list-user', [UserBackController::class,'index']);
    Route::get('order-user/{user}', [UserBackController::class,'show']);

    Route::get('product/{product}', [ProductBackController::class,'show']);
    Route::post('product/{product}', [ProductBackController::class,'update']);
    Route::delete('product/{product}', [ProductBackController::class,'destroy']);

});


Route::apiResource('carts', CartController::class);

Route::get('carts/count', [CartController::class, 'count'])->name('cart.count');
Route::get('carts/total', [CartController::class, 'cartTotal'])->name('cart.cartTotal');
Route::get('carts/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('carts/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('carts/removecart', [CartController::class, 'removeCart'])->name('cart.removeCart');
Route::get('products', [ProductController::class, 'index']);
Route::get('product-tendance', [ProductController::class, 'productTendance']);
Route::get('categories', [CategoryController::class, 'index']);



