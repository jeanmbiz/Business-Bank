<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\User\CreateUserService;
use App\Services\User\DeleteUserService;
use App\Services\User\listUsersService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $createUserService;

    protected $updateUserService;

    public function __construct(CreateUserService $createUserService, UpdateUserService $updateUserService)
    {
        $this->createUserService = $createUserService;
        $this->updateUserService = $updateUserService;
    }

    public function create(CreateUserRequest $request)
    {
        return $this->createUserService->execute($request->all());
    }

    public function listUsers()
    {
        $listUsersService = new listUsersService();

        return $listUsersService->execute();
    }

    public function update(UpdateUserRequest $request)
    {
        return $this->updateUserService->execute($request);
    }

    public function delete(Request $request)
    {
        $DeleteUserService = new DeleteUserService();

        return $DeleteUserService->delete($request);
    }
}
