<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create roles
        $superAdminRole = Role::create(['name' => 'superadmin']);
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $userRole = Role::create(['name' => 'user']);

        //List of permissions
        $permissions = [
            //Dashboard
            'dashboard.view',

            //Blog
            'blog.create',
            'blog.view',
            'blog.edit',
            'blog.delete',
            'blog.approve',

            //Admin
            'admin.create',
            'admin.view',
            'admin.edit',
            'admin.delete',
            'admin.approve',

            //Profile
            'profile.view',
            'profile.edit'
        ];

        //Create permission and assign to role
        foreach ($permissions as $permission) {
            //Create permission
            Permission::create(['name' => $permission]);

            //Assign permission
            $superAdminRole->givePermissionTo($permission);
        }
    }
}
