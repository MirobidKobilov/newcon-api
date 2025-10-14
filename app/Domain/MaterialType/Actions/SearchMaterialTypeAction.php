<?php

namespace App\Domain\MaterialType\Actions;

use App\Domain\MaterialType\Models\MaterialType;
use App\Http\Resources\MaterialTypeResource;
use Illuminate\Http\Request;

class SearchMaterialTypeAction{

    public function __invoke(Request $request)
    {
        $term = $request->term;

        $term = trim($term);

        if(empty($term)){
            return MaterialTypeResource::collection(MaterialType::all());
        }

        $material_type = MaterialType::where('name' , 'LIKE' , "%{$term}%")->get();

        return MaterialTypeResource::collection($material_type);
    }
}