<?php

use App\Http\Controllers\ThirdPartyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::prefix('users')->group(function() {
    Route::controller(UsersController::class)->group(function() {
        Route::get('/', 'findAll');
        Route::get('/score/leaderboard', 'getLeaderboard');
        Route::post('/score/submit', 'submitScore');
    });
});

Route::get('assessment', [ThirdPartyController::class, 'assessment']);