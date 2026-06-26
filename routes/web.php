<?php

use Illuminate\Support\Facades\Route;

// ─── Routes độc lập ─────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ─── Route Group với prefix /shop ───────────────────────────
Route::prefix('shop')->name('shop.')->group(function () {

    Route::get('/products', function () {
        return view('shop.products');
    })->name('products');
    // → URI: /shop/products  |  Tên: shop.products

    Route::get('/cart', function () {
        return view('shop.cart');
    })->name('cart');
    // → URI: /shop/cart  |  Tên: shop.cart

});
use App\Http\Controllers\ArticleController;

// Resource Route cho Articles
Route::resource('articles', ArticleController::class);