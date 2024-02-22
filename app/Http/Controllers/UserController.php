<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\User\CreateUserService;
use App\Services\User\DeleteUserService;
use App\Services\User\listActiveUsersService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        $createUserService = new CreateUserService();

        return $createUserService->execute($request->all());
    }

    public function listActiveUsers(){

        $listUsersService = new listActiveUsersService();

        return $listUsersService->execute();
    }

    public function update(UpdateUserRequest $request){

        $updateUserService = new UpdateUserService();

        return $updateUserService->execute($request->all());
    }

    public function delete(Request $request)
    {
        $DeleteUserService = new DeleteUserService();

        return $DeleteUserService->delete($request);
    }
}
