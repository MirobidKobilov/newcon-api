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
        $permissions = ['create product', 'see product'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'sanctum']
            );
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'sanctum']);
        $admin->givePermissionTo(Permission::all());

        $assistant = Role::firstOrCreate(['name' => 'assistant', 'guard_name' => 'sanctum']);
        $assistant->givePermissionTo('see product');

        $adminUser = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'phone' => '+998950200926',
                'password' => Hash::make('Adm1n'),
            ]
        );
        $adminUser->assignRole($admin);

        $assistantUser = User::firstOrCreate(
            ['username' => 'assistant'],
            [
                'phone' => '+998901234567',
                'password' => Hash::make('Assist1'),
            ]
        );
        $assistantUser->assignRole($assistant);
    }
}