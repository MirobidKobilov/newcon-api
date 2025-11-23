<?php

namespace App\Domain\MaterialType\Actions;

use App\Domain\MaterialType\Models\MaterialType;
use App\Http\Resources\MaterialTypeResource;
use Illuminate\Http\Request;

class GetMaterialTypeListAction
{
    public function execute(Request $request)
    {
        $validated = $request->validate([
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
        ]);

        $search = strtolower($validated['search'] ?? '');

        $query = MaterialType::query();

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
        }

        if (isset($validated['index']) || isset($validated['size'])) {
            $page = $validated['index'] ?? 1;
            $size = $validated['size'] ?? 10;
            $material_types = $query->paginate($size, ['*'], 'page', $page);
        } else {
            $material_types = $query->get();
        }

        return MaterialTypeResource::collection($material_types);
    }
}
