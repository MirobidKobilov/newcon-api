<?php

namespace App\Domain\User\Actions;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class GetUsersListAction{

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'pagination' => 'nullable|integer',
        ]);

        $page = $validated['pagination'] ?? 10;

        $users = User::paginate($page);
        return UserResource::collection($users);
    }
}