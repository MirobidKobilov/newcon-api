<?php

namespace App\Domain\Roles\Actions;

use App\Http\Resources\RolesResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SearchRoleAction{

    public function __invoke(Request $request)
    {
        $term = $request->term;

        $term = trim($term);

        if(empty($term)){
            return RolesResource::collection(Role::all());
        }

        $roles = Role::where('name' , 'LIKE' , "%{$term}%")
            ->get();

        return RolesResource::collection($roles);
    }
}