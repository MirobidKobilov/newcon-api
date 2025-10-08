<?php

namespace App\MaterialType\Actions;

use App\Http\Resources\MaterialTypeResource;
use App\MaterialType\Models\MaterialType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdateMaterialTypeAction
{

    public function __invoke(Request $request, $id)
    {
        $material_type = MaterialType::findOrFail($id);
        $data = $request->validate([
            'name' => 'nullable|string',
        ]);

        $material_type->update($data);

        return new MaterialTypeResource($material_type);
    }
}
