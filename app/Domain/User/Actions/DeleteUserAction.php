<?php

namespace App\Domain\User\Actions;

use App\Models\User;

class DeleteUserAction{

    public function execute($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
}