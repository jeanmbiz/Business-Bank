<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepositRequest;
use App\Http\Requests\CreateUserRequest;
use App\Services\CreateDepositService;
use Illuminate\Http\Request;
use App\Services\CreateUserService;

class UserController extends Controller {
    public function create(CreateUserRequest $request) {
        $createUserService = new CreateUserService();

        return $createUserService->execute($request->all());
    }

    public function deposit(CreateDepositRequest $request){
        $createDepositService = new CreateDepositService();
        return $createDepositService->execute(auth()->user()->id, $request->value);
    }
}
