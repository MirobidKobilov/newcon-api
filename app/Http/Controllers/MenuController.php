<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    protected $menu_service;

    public function __construct(MenuService $menu_service)
    {
        $this->menu_service = $menu_service;
    }

    public function menu(Request $request) 
    {
        $user = $request->user();

        if(!$user){
            return response()->json([
                'message' => 'User not found',
            ]);
        }

        $user->menu = $this->menu_service->getMenu($user);

        return new UserResource($user);
    }
}
