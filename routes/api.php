<?php

use App\Http\Controllers\BasketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/basket/checkout', [BasketController::class, 'checkout']);
