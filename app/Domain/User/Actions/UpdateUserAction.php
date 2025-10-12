<?php

namespace App\Domain\User\Actions;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            $roles = Role::whereIn('id', $data['role'])->pluck('name')->toArray();
            $user->syncRole($roles);
        }
        return new UserResource($user);
    }
}
