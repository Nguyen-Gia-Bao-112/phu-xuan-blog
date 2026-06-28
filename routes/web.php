<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ─── Trang chủ ──────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ─── Trang tĩnh ─────────────────────────────────────────────────────
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ─── Shop (từ Lab cũ) ──────────────────────────────────────────────
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/products', function () {
        return view('shop.products');
    })->name('products');

    Route::get('/cart', function () {
        return view('shop.cart');
    })->name('cart');
});

// ─── Resource Routes ─────────────────────────────────────────────────
Route::resource('articles', ArticleController::class);
Route::resource('posts', PostController::class);