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

// ─── Soft Delete Routes (PHẢI ĐẶT TRƯỚC Route::resource) ──────────
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');

// ─── Resource Routes ─────────────────────────────────────────────────
Route::resource('articles', ArticleController::class);
Route::resource('posts', PostController::class);