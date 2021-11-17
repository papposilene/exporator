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

        // Create permissions for places
        Permission::create(['name' => 'create places']);
        Permission::create(['name' => 'export places']);
        Permission::create(['name' => 'import places']);
        Permission::create(['name' => 'update places']);
        Permission::create(['name' => 'delete places']);
        Permission::create(['name' => 'restore places']);
        Permission::create(['name' => 'publish places']);
        Permission::create(['name' => 'unpublish places']);
        Permission::create(['name' => 'follow places']);
        Permission::create(['name' => 'unfollow places']);

        // Create permissions for exhibitions
        Permission::create(['name' => 'create exhibitions']);
        Permission::create(['name' => 'export exhibitions']);
        Permission::create(['name' => 'import exhibitions']);
        Permission::create(['name' => 'update exhibitions']);
        Permission::create(['name' => 'delete exhibitions']);
        Permission::create(['name' => 'restore exhibitions']);
        Permission::create(['name' => 'propose exhibitions']);
        Permission::create(['name' => 'publish exhibitions']);
        Permission::create(['name' => 'unpublish exhibitions']);
        Permission::create(['name' => 'follow exhibitions']);
        Permission::create(['name' => 'unfollow exhibitions']);

        // Create permissions for tags
        Permission::create(['name' => 'create tags']);
        Permission::create(['name' => 'export tags']);
        Permission::create(['name' => 'update tags']);
        Permission::create(['name' => 'delete tags']);
        Permission::create(['name' => 'restore tags']);
        Permission::create(['name' => 'publish tags']);
        Permission::create(['name' => 'unpublish tags']);
        Permission::create(['name' => 'follow tags']);
        Permission::create(['name' => 'unfollow tags']);

        // Create permissions for reviews
        Permission::create(['name' => 'create reviews']);
        Permission::create(['name' => 'export reviews']);
        Permission::create(['name' => 'update reviews']);
        Permission::create(['name' => 'delete reviews']);
        Permission::create(['name' => 'restore reviews']);
        Permission::create(['name' => 'publish reviews']);
        Permission::create(['name' => 'unpublish reviews']);
        Permission::create(['name' => 'follow reviews']);
        Permission::create(['name' => 'unfollow reviews']);

        // Create role for administrator
        $role = Role::create(['name' => 'super-admin'])
            ->givePermissionTo(Permission::all());

        // Create role for moderator
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo([
                'create places',
                'update places',
                'publish places',
                'unpublish places',
                'follow places',
                'unfollow places',
                'create exhibitions',
                'update exhibitions',
                'delete exhibitions',
                'restore exhibitions',
                'publish exhibitions',
                'unpublish exhibitions',
                'follow exhibitions',
                'unfollow exhibitions',
                'create tags',
                'update tags',
                'delete tags',
                'restore tags',
                'publish tags',
                'unpublish tags',
                'follow tags',
                'unfollow tags',
                'create reviews',
                'update reviews',
                'delete reviews',
                'restore reviews',
                'publish reviews',
                'unpublish reviews',
            ]);

        // Create role for editor
        $role = Role::create(['name' => 'editor'])
            ->givePermissionTo([
                'create places',
                'update places',
                'publish places',
                'unpublish places',
                'follow places',
                'unfollow places',
                'create exhibitions',
                'update exhibitions',
                'publish exhibitions',
                'unpublish exhibitions',
                'follow exhibitions',
                'unfollow exhibitions',
                'create tags',
                'update tags',
                'publish tags',
                'unpublish tags',
                'follow tags',
                'unfollow tags',
                'create reviews',
                'update reviews',
                'delete reviews',
                'publish reviews',
                'unpublish reviews',
            ]);

        // Create role for user
        $role = Role::create(['name' => 'user'])
            ->givePermissionTo([
                'follow places',
                'unfollow places',
                'propose exhibitions',
                'follow exhibitions',
                'unfollow exhibitions',
                'follow tags',
                'unfollow tags',
                'create reviews',
                'update reviews',
                'delete reviews',
                'publish reviews',
                'unpublish reviews',
            ]);
    }
}
