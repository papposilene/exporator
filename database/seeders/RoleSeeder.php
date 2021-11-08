<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create places']);
        Permission::create(['name' => 'update places']);
        Permission::create(['name' => 'delete places']);
        Permission::create(['name' => 'publish places']);
        Permission::create(['name' => 'unpublish places']);

        Permission::create(['name' => 'create exhibitions']);
        Permission::create(['name' => 'update exhibitions']);
        Permission::create(['name' => 'delete exhibitions']);
        Permission::create(['name' => 'publish exhibitions']);
        Permission::create(['name' => 'unpublish exhibitions']);

        Permission::create(['name' => 'create tags']);
        Permission::create(['name' => 'update tags']);
        Permission::create(['name' => 'delete tags']);
        Permission::create(['name' => 'publish tags']);
        Permission::create(['name' => 'unpublish tags']);

        Permission::create(['name' => 'create reviews']);
        Permission::create(['name' => 'update reviews']);
        Permission::create(['name' => 'delete reviews']);
        Permission::create(['name' => 'publish reviews']);
        Permission::create(['name' => 'unpublish reviews']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');

        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish articles', 'unpublish articles']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
