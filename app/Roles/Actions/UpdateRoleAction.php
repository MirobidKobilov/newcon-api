<?php

namespace App\Roles\Actions;

use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RolesResource;
use Spatie\Permission\Models\Role;

class UpdateRoleAction{

    public function __invoke(UpdateRoleRequest $request , $id)
    {
        $role = Role::findOrFail($id);

        $role->update($request->validated());

        if(!empty($request['permission'])){
            $role->givePermissionTo($request['permission']);
        }

        return new RolesResource($role);
    }
}