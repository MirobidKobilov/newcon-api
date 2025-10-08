<?php

namespace App\User\Actions;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserAction{

    public function __invoke(CreateUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if(!empty($data['role'])){
            $user->assignRole($data['role']);
        }

        if(!empty($data['permission'])){
            $user->givePermissionTo($data['permission']);
        }
        return new UserResource($user);
    }
}