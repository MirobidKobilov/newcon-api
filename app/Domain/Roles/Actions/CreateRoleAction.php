<?php

namespace App\Domain\Roles\Actions;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Resources\RolesResource;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRoleAction
{
    public function execute(CreateRoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'sanctum'
        ]);

        if (!empty($request->permission)) {
            $permissions = Permission::whereIn('id', $request->permission)
                ->pluck('name')
                ->toArray();

            $role->givePermissionTo($permissions);
        }

        return new RolesResource($role);
    }
}
