<?php

namespace App\Domain\MaterialType\Actions;

use App\Domain\MaterialType\Models\MaterialType;

class DeleteMaterialTypeAction{

    public function __invoke($id)
    {
        $material_type = MaterialType::findOrFail($id);

        $material_type->delete();

        return response()->json([
            'message' => 'Material type deleted successfully',
        ]);
    }
}