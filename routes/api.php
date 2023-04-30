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



Route::get('/product', [ProductControllers::class, 'index'])->middleware(['auth:sanctum']);
Route::get('/product/{id}', [ProductControllers::class, 'show']);

Route::post('/login',[AuthenticationController::class, 'login']);
Route::post('/signup',[AuthenticationController::class, 'signup']);
Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);