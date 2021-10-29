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
        $permissionGroups = [
            //Dashboard
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit'
                ]
            ],
            //Blog
            [
                'group_name' => 'blog',
                'permissions' => [
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve',
                ]
            ],
            //Admin
            [
                'group_name' => 'admin',
                'permissions' => [
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],
            //Profile
            [
                'group_name' => 'profile',
                'permissions' => [
                    'profile.view',
                    'profile.edit'
                ]
            ]
        ];

        //Create permission and assign to role
        foreach ($permissionGroups as $group) {
            $group_name = $group['group_name'];
            foreach ($group['permissions'] as $permission) {
                //Create permission
                Permission::create(['name' => $permission, 'group_name' => $group_name]);

                //Assign permission
                $superAdminRole->givePermissionTo($permission);
            }
        }
    }
}
