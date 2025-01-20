<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::prefix('users')->group(function() {
    Route::controller(UsersController::class)->group(function() {
        Route::get('/', 'findAll');
        Route::post('/score/submit', 'submitScore');
    });
});