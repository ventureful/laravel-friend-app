<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductControllers;
use App\Http\Controllers\AuthenticationController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    
    Route::post('/product', [ProductControllers::class, 'store']);
    Route::patch('/product/{id}', [ProductControllers::class, 'update'])->middleware('creatorproduct');
    Route::delete('/product/{id}', [ProductControllers::class, 'destroy'])->middleware('creatorproduct');

});

Route::get('/product', [ProductControllers::class, 'index']);
Route::get('/product/{id}', [ProductControllers::class, 'show']);

Route::post('/login',[AuthenticationController::class, 'login']);
Route::post('/signup',[AuthenticationController::class, 'signup']);
// Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);