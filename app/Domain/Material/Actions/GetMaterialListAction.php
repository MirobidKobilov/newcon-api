<?php

namespace App\Domain\Material\Actions;

use App\Domain\Material\Models\Material;
use App\Http\Resources\MaterialResource;
use Illuminate\Http\Request;

class GetMaterialListAction
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
        ]);

        $page = $validated['index'] ?? 1;
        $size = $validated['size'] ?? 10;
        $search = $validated['search'] ?? null;

        $query = Material::with('material_type');

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $materials = $query->paginate($size, ['*'], 'page', $page);

        return MaterialResource::collection($materials);
    }
}
