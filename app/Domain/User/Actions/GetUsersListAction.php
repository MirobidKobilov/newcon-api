<?php

namespace App\Domain\User\Actions;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class GetUsersListAction
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'pagination' => 'nullable|integer',
            'search' => 'nullable|string',
        ]);

        $page = $validated['pagination'] ?? 10;
        $search = $validated['search'] ?? null;

        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate($page);

        return UserResource::collection($users);
    }
}
