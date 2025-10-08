<?php

namespace App\Auth\Actions;


use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Support\Facades\Hash;

class LoginAction
{

    public function __invoke(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid username or password',
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        $user->token = $token;
        $user->menu = app(MenuService::class)->getMenu($user); 

        return new UserResource($user);
    }
}
