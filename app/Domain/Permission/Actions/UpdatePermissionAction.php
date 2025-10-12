<?php

namespace App\Domain\Permission\Actions;

use App\Http\Resources\PermissionsResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UpdatePermissionAction{

    public function __invoke(Request $request , $id)
    {
        $permission = Permission::findOrFail($id);

        $validated = $request->validate([
            'name' => 'nullable|string',
            'guard_name' => 'sanctum',
        ]);

        $permission->update($validated);

        return new PermissionsResource($permission);
    }
}