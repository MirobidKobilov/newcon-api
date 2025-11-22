<?php

namespace App\Domain\User\Actions;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UpdateUserAction
{
    public function execute(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->username = $request->username ?? $user->username;
        $user->phone = $request->phone ?? $user->phone;

        $user->save();  

        if (!empty($request->role)) {
            $roles = Role::whereIn('id', $request->role)->pluck('name')->toArray();
            $user->syncRoles($roles);
        }

        return new UserResource($user);
    }
}
