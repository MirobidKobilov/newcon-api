<?php

namespace App\Domain\Roles\Actions;

use Spatie\Permission\Models\Role;

class DeleteRoleAction{

    public function __invoke($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully',
        ]);
    }
}