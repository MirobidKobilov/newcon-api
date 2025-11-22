<?php

namespace App\Domain\Roles\Actions;

use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RolesResource;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateRoleAction
{

    public function execute(UpdateRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->update($request->validated());

        if (!empty($request->permission)) {
            $permissions = Permission::whereIn('id', $request->permission)
                ->pluck('name')
                ->toArray();

            $role->givePermissionTo($permissions);
        }

        return new RolesResource($role);
    }
}
