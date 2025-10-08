<?php

namespace App\Domain\Material\Actions;

use App\Domain\Material\Models\Material;
use App\Domain\MaterialType\Models\MaterialType;
use App\Http\Requests\CreateMaterialRequest;
use App\Http\Resources\MaterialResource;


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