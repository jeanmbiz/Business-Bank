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
            throw new AppError('Insufficient balance for transfer', 400);
        }

        $receiverUser = $this->userRepository->getUserByCpf($receiverCpf);

        if ($payerUser->id == $receiverUser->id) {
            throw new AppError('You cannot transfer money to your own account', 400);
        }

        $transaction = $this->transactionRepository->createTransaction($payerUser->id, $receiverUser->id, 'transference', $payerUser->name, $value);
        $this->userRepository->updateBalanceByTransference($payerUser, $receiverUser, $value);

        return response()->json($transaction);

    }
}
