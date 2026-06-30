<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ─── POSTS ROUTES ───────────────────────────────────────────────────

// 1. PUBLIC ROUTES (không cần login)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// ⚠️ QUAN TRỌNG: Các route cụ thể PHẢI ĐẶT TRƯỚC route động
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');

// Route động (có tham số) đặt SAU cùng
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Soft delete restore (cũng có tham số, đặt sau các route cụ thể)
Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');

// 2. PROTECTED ROUTES (cần login)
// ✅ Đã xóa middleware 'post.owner' – Policy sẽ kiểm tra quyền sở hữu
Route::middleware(['auth'])->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

require __DIR__.'/auth.php';