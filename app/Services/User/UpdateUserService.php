<?php

namespace App\Services\User;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UpdateUserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(Request $request)
    {
        $updateData = new \stdClass;

        if ($request->has('name')) {
            $updateData->name = $request->input('name');
        }

        if ($request->has('email')) {
            $this->userRepository->emailAlreadyExists($request['email']);
            $updateData->email = $request->input('email');
        }

        if ($request->has('password')) {
            $updateData->password = bcrypt($request->input('password'));
        }

        $request->input('user_DB')->update((array) $updateData);

        return response()->json($request->input('user_DB'));
    }
}
