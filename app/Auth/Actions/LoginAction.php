<?php

namespace App\Auth\Actions;


use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Support\Facades\Hash;

class LoginAction
{

    public function execute(LoginRequest $request)
    {
        try {
            $user = User::where('username', $request->username)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Invalid password',
                ], 401);
            }

            $token = $user->createToken('api-token')->plainTextToken;

            $user->token = $token;
            $user->menu = app(MenuService::class)->getMenu($user);

            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage(), 
            ], 500);
        }
    }
}
