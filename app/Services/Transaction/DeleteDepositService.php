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
        $deposit = $this->transactionRepository->findTransactionById($depositId);
        ['payer_id' => $payerId, 'receiver_id' => $receiverId, 'payer_name' => $payer, 'value' => $value] = $deposit;

        $transaction = $this->transactionRepository->createTransaction($payerId, $receiverId, "deposit refund regarding ${depositId}", $payer, -$value);

        $receiverUser = $this->userRepository->getUserById($deposit['receiver_id']);

        $this->userRepository->updateBalanceByDeposit($receiverUser, -$value);
        $deposit->delete();

        return $transaction;

    }
}
