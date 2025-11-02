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
            'pagination' => 'nullable|integer',
            'search' => 'nullable|string',
        ]);

        $page = $validated['pagination'] ?? 10;
        $search = $validated['search'] ?? null;

        $query = Material::with('material_type');

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $materials = $query->paginate($page);

        return MaterialResource::collection($materials);
    }
}
