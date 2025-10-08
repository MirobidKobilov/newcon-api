<?php

namespace App\Roles\Actions;

use App\Http\Resources\RolesResource;
use Spatie\Permission\Models\Role;

class GetRolesListAction{

    public function __invoke()
    {
        $roles = Role::with('permissions')->paginate(10);

        return RolesResource::collection($roles);
    }
}