<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class CreateDepositService
{
    protected $userModel;

    protected $transactionModel;

    protected $carbon;

    public function __construct(User $userModel, Transaction $transactionModel, Carbon $carbon)
    {
        $this->userModel = $userModel;
        $this->transactionModel = $transactionModel;
        $this->carbon = $carbon;
    }

    public function execute(array $data)
    {
        $receiverUser = $this->getUserByCpf($data['receiverCpf']);

        if (isset($data['payerCpf']) && $data['payerCpf']) {
            $payerUser = $this->getUserByCpf($data['payerCpf']);
            $payerName = $payerUser->name;
            $payerId = $payerUser->id;
        } else {
            $payerName = $receiverUser->name;
            $payerId = $receiverUser->id;
        }

        $transaction = new $this->transactionModel;
        $transaction->payer_id = $payerId;
        $transaction->receiver_id = $receiverUser->id;
        $transaction->date = Carbon::now()->toDateString();
        $transaction->transaction_type = 'deposit';
        $transaction->payer_name = $payerName;
        $transaction->value = $data['value'];

        $this->updateBalanceUser($receiverUser, $data['value']);

        $transaction->save();

        return $transaction;
    }

    protected function getUserByCpf($cpf)
    {
        $user = $this->userModel->where('cpf', $cpf)->first();

        if (is_null($user)) {
            throw new AppError('Usuário não encontrado', 404);
        }

        return $user;
    }

    protected function updateBalanceUser($receiverUser, $value)
    {
        $receiverUser->balance += $value;

        $receiverUser->save();
    }
}
