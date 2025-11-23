<?php
namespace App\Domain\Material\Actions;
use App\Domain\Material\Models\Material;
use App\Http\Resources\MaterialResource;
use Illuminate\Http\Request;

class GetMaterialListAction
{
    public function execute(Request $request)
    {
        $validated = $request->validate([
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
        ]);

        $search = strtolower($validated['search'] ?? '');

        $query = Material::with('material_type');

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
        }

        if (isset($validated['index']) || isset($validated['size'])) {
            $page = $validated['index'] ?? 1;
            $size = $validated['size'] ?? 10;
            $materials = $query->paginate($size, ['*'], 'page', $page);
        } else {
            $materials = $query->get();
        }

        return MaterialResource::collection($materials);
    }
}
