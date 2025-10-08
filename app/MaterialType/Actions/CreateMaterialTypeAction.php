<?php

namespace App\MaterialType\Actions;

use App\Http\Resources\MaterialTypeResource;
use App\MaterialType\Models\MaterialType;
use Illuminate\Http\Request;

class CreateMaterialTypeAction{

    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $material_type = MaterialType::create($data);

        return new MaterialTypeResource($material_type);
    }
}