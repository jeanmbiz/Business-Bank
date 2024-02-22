<?php

namespace App\Services\Transaction;

use App\Exceptions\AppError;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class CreateTransferenceService
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

        $payerUser = Auth::user();

        if ($value > $payerUser->balance) {
            throw new AppError('Saldo insuficiente para transferência.', 400);
        }

        $receiverUser = $this->userRepository->getUserByCpf($receiverCpf);

        if ($payerUser->id == $receiverUser->id) {
            throw new AppError('Você não pode transferir dinheiro para sua própria conta.', 400);
        }

        $this->userRepository->updateBalanceByTransference($payerUser, $receiverUser, $value);

        $transaction = $this->transactionRepository->createTransaction($payerUser->id, $receiverUser->id, 'transference', $payerUser->name, $value);

        return $transaction;

    }
}
