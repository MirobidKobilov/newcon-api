<?php

namespace App\MaterialType\Actions;

use App\Http\Resources\MaterialTypeResource;
use App\MaterialType\Models\MaterialType;

class GetMaterialTypeListAction{

    public function __invoke()
    {
        $material_types = MaterialType::paginate(10);

        return MaterialTypeResource::collection($material_types);
    }
}