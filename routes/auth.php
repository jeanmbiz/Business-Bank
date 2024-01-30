<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TesteController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'auth'
], function(){
    Route::post('/login', [AuthController::class, 'login']);
});
