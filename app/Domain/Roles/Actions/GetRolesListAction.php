<?php

namespace App\Domain\Roles\Actions;

use App\Http\Resources\RolesResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class GetRolesListAction{

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'pagination' => 'nullable|integer',
        ]);

        $page = $validated['pagination'] ?? 10;

        $roles = Role::with('permissions')->paginate($page);

        return RolesResource::collection($roles);
    }
}