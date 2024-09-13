<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BookApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::post('auth/login', [AuthApiController::class, 'login']);
    Route::post('auth/register', [AuthApiController::class, 'register']);
    Route::post('auth/refresh', [AuthApiController::class, 'refresh']);
    Route::post('auth/logout', [AuthApiController::class, 'logout']);
    Route::post('auth/me', [AuthApiController::class, 'me']);

    Route::middleware('auth:api')->group(function() {
        Route::post('/books', [BookApiController::class, 'store']);
        Route::put('/books/{id}', [BookApiController::class, 'update']);
        Route::delete('/books/{id}', [BookApiController::class, 'destroy']);
        Route::get('/books', [BookApiController::class, 'index']);
        Route::get('/books/{id}', [BookApiController::class, 'show']);
    });
});



