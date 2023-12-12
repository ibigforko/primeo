<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// API v1
Route::group(['prefix' => 'v1', 'as' => 'v1'], function () {
    // Authorization
    Route::group(['prefix' => 'auth', 'as' => '.auth'], function () {
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('.login');
        Route::post('/register', [RegisteredController::class, 'store'])->name('.register');
        Route::post('/reset', [ResetController::class, 'store'])->name('.reset.store');
        Route::post('/reset/{token}', [ResetController::class, 'update'])->name('.reset.update');
    });

    // Authenticate
    Route::middleware('auth:sanctum')->group(function () {
        // Authorization Logout
        Route::post('/auth/logout', [AuthenticatedSessionController::class, 'destroy'])->name('.logout');

        Route::put('users', [UsersController::class, 'store'])->name('.users.store');
        Route::post('users', [UsersController::class, 'update'])->name('.users.update');
        Route::delete('users', [UsersController::class, 'destroy'])->name('.users.destroy');
    });

    // Users
    Route::get('/users', [UsersController::class, 'index'])->name('.users.index');
});
