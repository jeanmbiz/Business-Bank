<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'transactions'], function (){
    Route::post('/deposit', [TransactionController::class, 'deposit']);

});

Route::middleware('jwt.verify')->group(function () {
    Route::post('/transactions', [TransactionController::class, 'create']);
});
