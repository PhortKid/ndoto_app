<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('pay',[PaymentController::class,'createOrder']);
Route::post('check_order',[PaymentController::class,'checkOrderStatus']);
Route::post('payment_success',[PaymentController::class,'paymentSuccess']);


Route::get('demo', fn() => 1); 
