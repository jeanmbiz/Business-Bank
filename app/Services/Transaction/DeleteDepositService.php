<?php

namespace App\Services\Transaction;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class DeleteDepositService
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
        $depositId = $request->route('depositId');
        $deposit = $this->transactionRepository->getTransactionById($depositId);

        $this->transactionRepository->verifyTransactionType($deposit['transaction_type'], 'deposit');

        ['payer_id' => $payerId, 'receiver_id' => $receiverId, 'payer_name' => $payer, 'value' => $value] = $deposit;

        $receiverUser = $this->userRepository->getUserById($deposit['receiver_id']);

        $transaction = $this->transactionRepository->createTransaction($payerId, $receiverId, "deposit refund ${depositId}", $payer, -$value);
        $this->userRepository->updateBalanceByDeposit($receiverUser, -$value);
        $deposit->delete();

        return response()->json($transaction);

    }
}
