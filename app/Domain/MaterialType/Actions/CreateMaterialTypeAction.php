<?php

namespace App\Domain\MaterialType\Actions;

use App\Domain\MaterialType\Models\MaterialType;
use App\Http\Resources\MaterialTypeResource;
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