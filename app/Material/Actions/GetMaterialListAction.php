<?php

namespace App\Material\Actions;

use App\Http\Resources\MaterialResource;
use App\Material\Models\Material;

class GetMaterialListAction{

    public function __invoke()
    {
        $materials = Material::with('material_type')->paginate(10);

        return MaterialResource::collection($materials);
    }
}