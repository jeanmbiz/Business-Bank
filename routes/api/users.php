<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'users'
    ], function(){
        Route::post('', [UserController::class, 'create'] );

        Route::middleware('jwt.verify')->group(function(){
            Route::post('{id}/deposit', [UserController::class, 'deposit']);
    });
});
