<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Commerce\ProductController;
use App\Http\Controllers\Api\Commerce\CartController;

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

// Route::middleware(['auth:sanctum'])->group(function () {

//     Route::get('/user', function(Request $request){
//         return $request->user();
//     }) ; 
//     Route::apiResource('carts', CartController::class);
//     Route::get('carts/count', [CartController::class, 'count']);
    
// });


Route::group(['middleware' =>['auth:sanctum']], function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    }) ; 
   
});


Route::apiResource('carts', CartController::class);

Route::get('carts/count', [CartController::class, 'count'])->name('cart.count');
Route::get('carts/total', [CartController::class, 'cartTotal'])->name('cart.cartTotal');
Route::get('carts/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('carts/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('carts/removecart', [CartController::class, 'removeCart'])->name('cart.removeCart');

// Route::group(['middleware' =>['auth:sanctum']], function(){
//     Route::get('/user', function(Request $request)){
//         return $request->user();
//     }
// });


Route::get('products', [ProductController::class, 'index']);



