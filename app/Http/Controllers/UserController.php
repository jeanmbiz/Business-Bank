<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {
    public function create(Request $request){
        return User::create($request->all());

    }
}
