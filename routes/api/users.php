<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'users',
], function () {
    Route::post('', [UserController::class, 'create']);

    Route::patch('/{userId}', [UserController::class, 'update']);

    Route::middleware(['jwt.verify', 'isSameUser.verify'])->group(function () {
        Route::delete('/{userId}', [UserController::class, 'delete']);
    });

    Route::middleware(['jwt.verify', 'isAdmin.verify'])->group(function () {
        Route::delete('/{userId}/admin', [UserController::class, 'delete']);
    });

});
