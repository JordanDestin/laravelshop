<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('login', [
    \App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('logout', [
    \App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy']);

Route::post('register', [
    \App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

Route::post('login-back', [
    \App\Http\Controllers\Api\Admin\AuthBackController::class, 'loginBack']);

Route::view('/{any?}', 'dashboard')
    ->name('dashboard')
    ->where('any', '.*');
