<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class ListOwnTransactionsService
{
    protected $userRepository;

    protected $transactionRepository;

    public function __construct(UserRepository $userRepository, TransactionRepository $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function execute($request)
    {
        $userId = $request['user_id'];

        $transactions = Transaction::where('payer_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->orderBy('date', 'asc')
            ->withTrashed()
            ->select('id', 'date', 'payer_name', 'transaction_type', 'value')
            ->paginate(10);

        return response()->json($transactions);

    }
}
