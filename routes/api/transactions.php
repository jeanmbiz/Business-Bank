<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'transactions'], function () {
    Route::post('/deposit', [TransactionController::class, 'deposit']);

    Route::middleware('jwt.verify')->group(function () {
        Route::post('/transference', [TransactionController::class, 'transference']);
    });

    Route::middleware(['jwt.verify', 'isSameUser.verify'])->group(function () {
        Route::get('/{userId}', [TransactionController::class, 'listOwnTransactions']);
        Route::get('/balance/{userId}', [TransactionController::class, 'listOwnBalance']);
    });

    Route::middleware(['jwt.verify', 'isAdmin.verify'])->group(function () {
        Route::delete('/deposit/{depositId}', [TransactionController::class, 'deleteDeposit']);
        Route::delete('/transference/{transferenceId}', [TransactionController::class, 'deleteTransference']);
    });

});
