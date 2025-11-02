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
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
        ]);

        $page = $validated['index'] ?? 1;
        $size = $validated['size'] ?? 10;
        $search = strtolower($validated['search'] ?? '');

        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(username) LIKE ?', ["%{$search}%"])
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate($size, ['*'], 'page', $page);

        return UserResource::collection($users);
    }
}
