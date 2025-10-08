<?php

namespace App\User\Actions;

use App\Models\User;

class DeleteUserAction{

    public function __invoke($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
}