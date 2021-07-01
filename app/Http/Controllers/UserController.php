<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::filter()->paginate();
        return UserResource::collection($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'mobile' => 'required',
            'ability' => 'nullbale|array',
        ]);

        $user = User::findOrFail($id);

        $user->update($request->only(['email', 'mobile', 'ability']));

        return new UserResource($user);
    }
}
