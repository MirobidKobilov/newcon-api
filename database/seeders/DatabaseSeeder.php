<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
            'list_user',
            'create_user',
            'update_user',
            'delete_user',
            'list_permission',
            'create_permission',
            'update_permission',
            'delete_permission',
            'list_role',
            'create_role',
            'update_role',
            'delete_role',
            'list_material_type',
            'create_material_type',
            'update_material_type',
            'delete_material_type',
            'list_material',
            'create_material',
            'update_material',
            'delete_material',
            'list_company',
            'create_company',
            'update_company',
            'delete_company',
            'list_sale',
            'create_sale',
            'list_payment',
            'create_payment',
            'list_expance',
            'create_expance',
            'list_actions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'sanctum']
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