<?php

namespace App\Roles\Actions;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Resources\RolesResource;
use Spatie\Permission\Models\Role;

class CreateRoleAction{

    public function __invoke(CreateRoleRequest $request)
    {
        $role = Role::create($request->validated());

        if(!empty($request['permission'])){
            $role->givePermissionTo($request['permission']);
        }

        return new RolesResource($role);
    }
}