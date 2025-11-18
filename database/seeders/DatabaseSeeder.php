<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'list_product',
            'create_product',
            'update_product',
            'delete_product',
            'export_product',
            'list_user',
            'create_user',
            'update_user',
            'delete_user',
            'export_user',
            'list_permission',
            'create_permission',
            'update_permission',
            'delete_permission',
            'list_role',
            'create_role',
            'update_role',
            'delete_role',
            'export_role',
            'list_material_type',
            'create_material_type',
            'update_material_type',
            'delete_material_type',
            'search_material_type',
            'list_material',
            'create_material',
            'update_material',
            'delete_material',
            'export_material',
            'list_company',
            'create_company',
            'update_company',
            'delete_company',
            'export_company',
            'show_company',
            'overall_debt_company',
            'list_sale',
            'create_sale',
            'export_sale',
            'list_payment',
            'create_payment',
            'update_payment',
            'list_expance',
            'create_expance',
            'search_expance',
            'export_expance',
            'calculate_expances',
            'list_actions',
            'sale_by_day',
            'sale_by_month',
            'list_worker',
            'create_worker',
            'update_worker',
            'delete_worker',
        ];


        //

        foreach ($permissions as $permission) {

            Permission::firstOrCreate(
                [
                    'name' => $permission,
                    'guard_name' => 'sanctum'
                ],
                [
                    'slug' => Str::slug($permission, '-'),
                    'description' => ucfirst(str_replace('_', ' ', $permission)),
                ]
            );
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'sanctum']);

        $admin->syncPermissions(Permission::all());

        $adminUser = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'phone' => '+998950200926',
                'password' => Hash::make('Adm1n'),
            ]
        );

        $adminUser->assignRole($admin);
    }
}
