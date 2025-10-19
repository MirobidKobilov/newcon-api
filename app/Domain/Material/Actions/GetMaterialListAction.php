<?php

namespace App\Domain\Material\Actions;

use App\Domain\Material\Models\Material;
use App\Http\Resources\MaterialResource;
use Illuminate\Http\Request;

class GetMaterialListAction{

    public function __invoke(Request $request)
    {

        $validate = $request->validate([
            'pagination' => 'nullable'
        ]);

        $page = $validate['pagination'] ?? 10;
        $materials = Material::with('material_type')->paginate($page);

        return MaterialResource::collection($materials);
    }
}