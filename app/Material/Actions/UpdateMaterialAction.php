<?php

namespace App\Material\Actions;

use App\Http\Requests\UpdateMaterialRequest;
use App\Http\Resources\MaterialResource;
use App\Material\Models\Material;
use App\MaterialType\Models\MaterialType;

class UpdateMaterialAction
{

    public function __invoke(UpdateMaterialRequest $request, $id)
    {
        $material = Material::findOrFail($id);

        $data = $request->validated();

        if (!MaterialType::where('id', $request->material_type_id)->exists()) {
            return response()->json([
                'message' => 'Material type is not exist'
            ], 422);
        }

        $material->update($data);

        return new MaterialResource($material);
    }
}
