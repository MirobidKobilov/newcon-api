<?php

namespace App\Permission\Actions;

use App\Http\Resources\PermissionsResource;
use Spatie\Permission\Models\Permission;

class GetPermissionsListAction{

    public function __invoke()
    {
        $permissions = Permission::paginate(10);
        return PermissionsResource::collection($permissions);
    }
}