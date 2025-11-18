<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class MenuService
{
    public function getMenu($user = null)
    {
        $user = $user ?? Auth::user();

        if (!$user) {
            return [];
        }

        $config = config('menu');
        return $this->filterMenu($config, $user);
    }

    private function filterMenu(array $items, $user)
    {
        $menu = [];

        foreach ($items as $key => $item) {

            if (!$this->userCanSee($user, $item['permissions'] ?? [])) {
                continue;
            }

            $entry = [
                'title' => $item['title']
            ];

            if (!empty($item['route'])) {
                $entry['route'] = $item['route'];
            }

            // Recursive child filtering
            if (!empty($item['children'])) {
                $children = $this->filterMenu($item['children'], $user);

                if (!empty($children)) {
                    $entry['children'] = $children;
                }
            }

            $menu[$key] = $entry;
        }

        return $menu;
    }

    private function userCanSee($user, array $permissions): bool
    {
        if (empty($permissions)) {
            return true;
        }

        return $user->hasAnyPermission($permissions);
    }
}
