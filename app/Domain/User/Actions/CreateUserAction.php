<?php

namespace App\Domain\User\Actions;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateUserAction
{
    public function execute(CreateUserRequest $request)
    {
        $user = new User();

        $user->password = Hash::make($request->password);

        $user->username = $request->username;
        $user->phone = $request->phone;

        $user->save();
        if (!empty($request['role'])) {
            $roles = Role::whereIn('id', $request['role'])->pluck('name')->toArray();
            $user->assignRole($roles);
        }


        return new UserResource($user);
    }
}
