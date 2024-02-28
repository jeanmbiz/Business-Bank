<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\UserRepository;

class CreateUserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array $data)
    {
        ['email' => $email, 'cpf' => $cpf] = $data;

        $this->userRepository->verifyEmail($email);

        $this->userRepository->verifyCpf($cpf);

        return response()->json(User::create($data));
    }
}
