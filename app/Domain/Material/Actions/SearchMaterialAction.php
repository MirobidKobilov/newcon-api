<?php

namespace App\Domain\Material\Actions;

use App\Domain\Material\Models\Material;
use App\Http\Resources\MaterialResource;
use Illuminate\Http\Request;

class SearchMaterialAction{

    public function __invoke(Request $request)
    {
        $term = $request->term;

        $term = trim($term);

        if(empty($term)){
            return MaterialResource::collection($term);
        }

        $material = Material::where('name' , 'LIKE' , "%{$term}%")
                    ->orWhere('size' , 'LIKE' , "%{$term}%")
                    ->orWhere('quantity' , "=" , $term)
                    ->get();
        return MaterialResource::collection($material);
    }
}