<?php

namespace App\Domain\Permission\Actions;

use Spatie\Permission\Models\Permission;

class DeletePermissionAction{

    public function __invoke($id)
    {
        $permission = Permission::findOrFail($id);

        $permission->delete();

        return response()->json([
            'message' => 'Permission deleted successfully',
        ]);
    }
}