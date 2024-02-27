<?php

namespace App\Services\Transaction;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class ListOwnBalanceService
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
        $response = [
            'balance' => $request['user_DB']->balance
        ];

        return response()->json($response);

    }
}
