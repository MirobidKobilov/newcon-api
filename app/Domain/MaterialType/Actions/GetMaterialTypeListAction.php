<?php

namespace App\Domain\MaterialType\Actions;

use App\Domain\MaterialType\Models\MaterialType;
use App\Http\Resources\MaterialTypeResource;

class GetMaterialTypeListAction{

    public function __invoke()
    {
        $material_types = MaterialType::paginate(10);

        return MaterialTypeResource::collection($material_types);
    }
}