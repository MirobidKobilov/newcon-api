<?php

namespace App\Domain\Material\Actions;

use App\Domain\Material\Models\Material;

class DeleteMaterialAction{

    public function execute($id)
    {
        $material = Material::findOrFail($id);

        $material->delete();

        return response()->json([
            'message' => 'Material deleted successfullly',
        ]);
    }
}