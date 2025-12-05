<?php

namespace App\Domain\Permission\Actions;

use App\Http\Resources\PermissionsResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class GetPermissionsListAction
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
        ]);

        $page = $validated['index'] ?? null;
        $size = $validated['size'] ?? null;
        $search = $validated['search'] ?? null;

        $query = Permission::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if (!$page || !$size) {
            $permissions = $query->get();
            return PermissionsResource::collection($permissions);
        }

        $permissions = $query->paginate(
            $size,
            ['*'],
            'page',
            $page
        );

        return PermissionsResource::collection($permissions);
    }
}
