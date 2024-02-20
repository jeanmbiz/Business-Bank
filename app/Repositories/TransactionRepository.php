<?php

namespace App\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRepository
{
    protected $transactionModel;

    public function __construct(Transaction $transactionModel)
    {
        $this->transactionModel = $transactionModel;
    }

    public function createTransaction($payerId, $receiverId, $transactionType, $payerName, $value)
    {
        $transaction = new $this->transactionModel;
        $transaction->payer_id = $payerId;
        $transaction->receiver_id = $receiverId;
        $transaction->date = Carbon::now()->toDateString();
        $transaction->transaction_type = $transactionType;
        $transaction->payer_name = $payerName;
        $transaction->value = $value;

        $transaction->save();

        return $transaction;
    }
}
