<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class CreateDepositService
{
    protected $userRepository;

    protected $transactionRepository;

    public function __construct(UserRepository $userRepository, TransactionRepository $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function execute(array $data)
    {

        ['receiverCpf' => $receiverCpf, 'value' => $value] = $data;

        $receiverUser = $this->userRepository->getUserByCpf($receiverCpf);

        if (isset($data['payerCpf']) && $data['payerCpf']) {
            $payerUser = $this->userRepository->getUserByCpf($data['payerCpf']);
            $payerName = $payerUser->name;
            $payerId = $payerUser->id;
        } else {
            $payerName = $receiverUser->name;
            $payerId = $receiverUser->id;
        }

        $this->userRepository->updateBalanceByDeposit($receiverUser, $value);

        $transaction = $this->transactionRepository->createTransaction($payerId, $receiverUser->id, 'deposit', $payerName, $value);

        return $transaction;
    }
}
