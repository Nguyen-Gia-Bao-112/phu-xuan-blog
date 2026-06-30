<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->name('api.v1.')->group(function () {

    // ✅ Cách viết gọn: apiResource() tự động tạo 5 routes CRUD
    // Tương đương: index, store, show, update, destroy
    Route::apiResource('posts', PostController::class);

});