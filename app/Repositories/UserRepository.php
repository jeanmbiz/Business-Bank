<?php

namespace App\Repositories;

use App\Exceptions\AppError;
use App\Models\User;

class UserRepository
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getUserByCpf($cpf)
    {
        $user = $this->userModel->where('cpf', $cpf)->first();

        if (is_null($user)) {
            throw new AppError('Usuário não encontrado', 401);
        }

        return $user;
    }

    public function updateBalanceByDeposit($receiverUser, $value)
    {
        $receiverUser->balance += $value;
        $receiverUser->save();
    }

    public function updateBalanceByTransference($payerUser, $receiverUser, $value)
    {
        $payerUser->balance -= $value;
        $receiverUser->balance += $value;
        $payerUser->save();
        $receiverUser->save();
    }
}
