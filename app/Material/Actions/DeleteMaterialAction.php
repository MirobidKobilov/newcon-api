<?php

namespace App\Material\Actions;

use App\Material\Models\Material;

class DeleteMaterialAction{

    public function __invoke($id)
    {
        $material = Material::findOrFail($id);

        $material->delete();

        return response()->json([
            'message' => 'Material deleted successfullly',
        ]);
    }
}