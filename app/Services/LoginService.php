<?php

namespace App\Services;

use App\Exceptions\AppError;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginService {
    public function execute(array $credentials) {

        if (! Auth::attempt($credentials)) {
            throw new AppError('Incorrect email or password', 401);
        }

        $user = Auth::user();

        $token = JWTAuth::fromUser($user, [
            'user_id'      => $user->id,
            'user_cpf'     => $user->cpf,
            'user_isAdmin' => $user->isAdmin,
        ]);

        return $this->respondWithToken($token, $user);
    }

    private function respondWithToken($token, $user) {

        return response()->json([
            'token' => $token,
            'user'  => $user->only(['id', 'name', 'email']),
        ]);
    }
}
