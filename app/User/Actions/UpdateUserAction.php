<?php

namespace App\User\Actions;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction
{

    public function __invoke(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        if (!empty($data['role'])) {
            $user->assignRole($data['role']);
        }

        if (!empty($data['permission'])) {
            $user->givePermissionTo($data['permission']);
        }
        return new UserResource($user);
    }
}
