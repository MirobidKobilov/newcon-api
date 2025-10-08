<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class MenuService
{
    public function getMenu($user = null)
    {
        $user = $user ??  Auth::user();

        if(!$user){
            return response()->json([
                'message' => 'User not found'
            ]);
        }
        $config = config('menu');
        $menu = [];

        foreach ($config as $key => $item) {
            if ($this->userCanSee($user, $item['permissions'] ?? [])) {
                $menu[$key] = [
                    'title' => $item['title'],
                ];

                if (!empty($item['route'])) {
                    $menu[$key]['route'] = $item['route'];
                }

                if (!empty($item['children'])) {
                    $children = [];

                    foreach ($item['children'] as $childKey => $childItem) {
                        if ($this->userCanSee($user, $childItem['permissions'] ?? [])) {
                            $children[$childKey] = [
                                'title' => $childItem['title'],
                            ];

                            if (!empty($childItem['route'])) {
                                $children[$childKey]['route'] = $childItem['route'];
                            }
                        }
                    }

                    if (!empty($children)) {
                        $menu[$key]['children'] = $children;
                    }
                }
            }
        }

        return $menu;
    }

    private function userCanSee($user, array $permissions): bool
    {
        if (empty($permissions)) {
            return true; 
        }

        foreach ($permissions as $permission) {
            if ($user->can($permission)) {
                return true;
            }
        }

        return false;
    }
}
