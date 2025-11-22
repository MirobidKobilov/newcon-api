<?php

namespace App\Domain\Material\Actions;

use App\Domain\Material\Models\Material;
use App\Domain\MaterialType\Models\MaterialType;
use App\Http\Requests\UpdateMaterialRequest;
use App\Http\Resources\MaterialResource;

class UpdateMaterialAction
{
    public function execute(UpdateMaterialRequest $request, $id)
    {
        $material = Material::findOrFail($id);

        $material->name = $request->name ?? $material->name;
        $material->size = $request->size ?? $material->size;
        $material->quantity = $request->quantity ?? $material->quantity;
        $material->material_type_id = $request->material_type_id ?? $material->material_type_id;

        $material->save();

        return new MaterialResource($material);
    }
}
