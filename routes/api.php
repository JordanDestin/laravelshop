<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Commerce\ProductController;
use App\Http\Controllers\Api\Commerce\CategoryController;
use App\Http\Controllers\Api\Commerce\CartController;
use App\Http\Controllers\Api\Commerce\StripeCheckoutController;
use App\Http\Controllers\Api\Commerce\OrderController;
use App\Http\Controllers\Api\Admin\ProductBackController;

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
    // Route::get('/user', function(Request $request){
    //     return $request->user();
    // }) ; 
   
     Route::post('paymentIntent',[StripeCheckoutController::class,'paymentIntent']);

     Route::get('orders',[OrderController::class,'index'])->name('orders.index');
     Route::post('orders',[OrderController::class,'store'])->name('orders.store');

     Route::get('order/{id}',[OrderController::class,'detailOrder'])->name('order.detailOrder');

     //ADMIN
     
  //   Route::get('list-product', [ProductBackController::class, 'index']);
   //  Route::get('admin-products', [ProductBackController::class, 'index']);
     Route::apiResource('admin-products', ProductBackController::class);
     
});


Route::apiResource('carts', CartController::class);

Route::get('carts/count', [CartController::class, 'count'])->name('cart.count');
Route::get('carts/total', [CartController::class, 'cartTotal'])->name('cart.cartTotal');
Route::get('carts/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('carts/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('carts/removecart', [CartController::class, 'removeCart'])->name('cart.removeCart');
Route::get('products', [ProductController::class, 'index']);
Route::get('categories', [CategoryController::class, 'index']);



