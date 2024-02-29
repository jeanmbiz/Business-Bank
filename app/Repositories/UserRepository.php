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

    public function getUserById($id)
    {
        $user = $this->userModel->where('id', $id)->first();

        if (is_null($user)) {
            throw new AppError('User ID does not exist or is not active on the system', 404);
        }

        return $user;
    }

    public function getUserByCpf($cpf)
    {
        $user = $this->userModel->where('cpf', $cpf)->first();

        if (is_null($user)) {
            throw new AppError('User CPF does not exist or is not active on the system', 404);
        }

        return $user;
    }

    public function verifyEmail($email)
    {
        $user = $this->userModel->withTrashed()->where('email', $email)->first();

        if ($user) {
            throw new AppError('E-mail already registered', 400);
        }

    }

    public function verifyCpf($cpf)
    {
        $user = $this->userModel->withTrashed()->where('cpf', $cpf)->first();

        if ($user) {
            throw new AppError('CPF already registered', 400);
        }

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
