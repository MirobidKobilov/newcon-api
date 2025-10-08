<?php

namespace App\Domain\Material\Actions;

use App\Domain\Material\Models\Material;
use App\Http\Resources\MaterialResource;

class GetMaterialListAction{

    public function __invoke()
    {
        $materials = Material::with('material_type')->paginate(10);

        return MaterialResource::collection($materials);
    }
}