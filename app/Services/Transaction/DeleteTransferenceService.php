<?php

namespace App\Services\Transaction;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class DeleteTransferenceService
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
        $transferenceId = $request->route('transferenceId');
        $transference = $this->transactionRepository->getTransactionById($transferenceId);

        $this->transactionRepository->verifyTransactionType($transference['transaction_type'], 'transference');

        ['payer_id' => $payerId, 'receiver_id' => $receiverId, 'payer_name' => $payer, 'value' => $value] = $transference;

        $payerUser = $this->userRepository->getUserById($transference['payer_id']);
        $receiverUser = $this->userRepository->getUserById($transference['receiver_id']);

        $transaction = $this->transactionRepository->createTransaction($payerId, $receiverId, "transference refund ${transferenceId}", $payer, -$value);
        $this->userRepository->updateBalanceByTransference($payerUser, $receiverUser, -$value);
        $transference->delete();

        return response()->json($transaction);

    }
}
