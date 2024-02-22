<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $loginService = new AuthService();

        return $loginService->execute($request->all());
    }
}
