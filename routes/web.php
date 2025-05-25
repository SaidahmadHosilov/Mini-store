<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/basket/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);

    /* Basket */
    Route::get('/basket', [BasketController::class, 'getBasket'])->name('basket.index');
    Route::post('/basket/{productId}', [BasketController::class, 'addToBasket'])->name('basket.add');
    // Miqdorlarni yangilash
    Route::put('/basket/update', [BasketController::class, 'updateBasket'])->name('basket.update');
    // Mahsulotni o'chirish
    Route::post('/basket/remove/{id}', [BasketController::class, 'removeFromBasket'])->name('basket.remove');
    // Zakazni oformit qilish
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
