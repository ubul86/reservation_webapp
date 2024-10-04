<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PlaceController;
use \App\Http\Controllers\UserController;

Route::post('/registration', [RegistrationController::class, 'registration']);

Route::post('/activation', [RegistrationController::class, 'activation'])->name('activate');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

Route::get('/reservation/{date}', [ReservationController::class, 'index']);

Route::get('/places', [PlaceController::class, 'getPlaces']);

Route::middleware('auth.api')->group(function () {
    Route::get('/user', [UserController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/reservation/bulk-store', [ReservationController::class, 'bulkStore']);
});
