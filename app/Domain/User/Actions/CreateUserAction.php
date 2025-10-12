<?php

namespace App\Domain\User\Actions;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateUserAction
{
    public function __invoke(CreateUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if (!empty($data['role'])) {
            $roles = Role::whereIn('id', $data['role'])->pluck('name')->toArray();
            $user->assignRole($roles);
        }

        return new UserResource($user);
    }
}
