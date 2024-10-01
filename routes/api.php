<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PlaceController;

Route::post('/registration', [RegistrationController::class, 'registration']);

Route::post('/activation', [RegistrationController::class, 'activation'])->name('activate');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/reservation/{date}', [ReservationController::class, 'index']);

Route::get('/places', [PlaceController::class, 'getPlaces']);

Route::middleware('auth.api')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
