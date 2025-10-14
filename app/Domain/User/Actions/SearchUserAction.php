<?php


namespace App\Domain\User\Actions;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class SearchUserAction{

    public function __invoke(Request $request)
    {
        $term = $request->term;

        if(empty($term)){
            return UserResource::collection(User::all());
        }

        $term = trim($term);

        $user = User::where('username' , 'LIKE' , "%{$term}%")
                ->orWhere('phone' , 'LIKE' , "%{$term}%")
                ->limit(20)
                ->get();

        return UserResource::collection($user);
    }
}