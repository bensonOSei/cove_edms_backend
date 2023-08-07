<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function create(UserRequest $request)
    {
        $user = $request->validated();

        $user['password'] = bcrypt($user['password']);
        $user = User::create($user);

        return new UserResource($user);
    }
}
