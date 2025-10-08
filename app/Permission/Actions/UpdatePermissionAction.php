<?php

namespace App\Permission\Actions;

use App\Http\Resources\PermissionsResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UpdatePermissionAction{

    public function __invoke(Request $request , $id)
    {
        $permission = Permission::findOrFail($id);

        $validated = $request->validate([
            'name' => 'nullable|string',
        ]);

        $permission->update($validated);

        return new PermissionsResource($permission);
    }
}