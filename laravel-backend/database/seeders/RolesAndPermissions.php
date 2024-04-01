<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'manage:users']);

        Role::create(['name' => 'admin'])->givePermissionTo('manage:users');
        Role::create(['name' => 'user']);
    }
}
