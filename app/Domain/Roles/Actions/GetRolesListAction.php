<?php

namespace App\Domain\Roles\Actions;

use App\Http\Resources\RolesResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class GetRolesListAction
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'pagination' => 'nullable|integer',
            'search' => 'nullable|string',
        ]);

        $page = $validated['pagination'] ?? 10;
        $search = $validated['search'] ?? null;

        $query = Role::with('permissions');

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $roles = $query->paginate($page);

        return RolesResource::collection($roles);
    }
}
