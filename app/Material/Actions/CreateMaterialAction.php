<?php

namespace App\Material\Actions;

use App\Http\Requests\CreateMaterialRequest;
use App\Http\Resources\MaterialResource;
use App\Material\Models\Material;
use App\MaterialType\Models\MaterialType;

class CreateMaterialAction{

    public function __invoke(CreateMaterialRequest $request)
    {
        if(!MaterialType::where('id' , $request->material_type_id)->exists()){
            return response()->json([
                'message' => 'Material type is not exist'
            ] , 422);
        }
        $material = Material::create($request->validated());

        return new MaterialResource($material);
    }
}