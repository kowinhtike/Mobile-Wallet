<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/create-profile', [ProfileController::class, 'createProfile']);
    Route::get('/get-profile', [ProfileController::class, 'getProfile']);
    Route::post('/create-transaction', [ProfileController::class, 'createTransaction']);
    Route::get('/get-transactions', [ProfileController::class, 'getTransactions']);
    Route::post('/set-pin', [ProfileController::class, 'setPin']);
    Route::post('/set-photo', [ProfileController::class, 'setPhoto']);
});