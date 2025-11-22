<?php

namespace App\Domain\Material\Actions;

use App\Domain\Material\Models\Material;
use App\Domain\MaterialType\Models\MaterialType;
use App\Http\Requests\CreateMaterialRequest;
use App\Http\Resources\MaterialResource;


class CreateMaterialAction
{

    public function execute(CreateMaterialRequest $request)
    {
        $material = new Material();
        $material->name = $request->name;
        $material->size = $request->size;
        $material->quantity = $request->quantity;
        $material->material_type_id = $request->material_type_id; 
        $material->save();

        return new MaterialResource($material);
    }
}
