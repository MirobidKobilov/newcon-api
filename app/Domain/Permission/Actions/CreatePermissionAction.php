<?php

namespace App\Domain\Permission\Actions;

use App\Http\Resources\PermissionsResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class CreatePermissionAction
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'sanctum',
        ]);

        return new PermissionsResource($permission);
    }
}
