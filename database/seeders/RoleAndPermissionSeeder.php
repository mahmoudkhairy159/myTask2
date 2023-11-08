<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        //Permission::create(['name' => 'create-users']);
        //Permission::create(['name' => 'edit-users']);
        //Permission::create(['name' => 'delete-users']);

        //Permission::create(['name' => 'create-blog-posts']);
        //Permission::create(['name' => 'edit-blog-posts']);
        //Permission::create(['name' => 'delete-blog-posts']);
        $superAdminRole = Role::create(['name' => 'SuperAdmin']);
        $adminRole = Role::create(['guard_name' => 'admin','name' => 'Admin']);
        $customerRole = Role::create(['guard_name' => 'web','name' => 'Customer']);

       /* $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-blog-posts',
            'edit-blog-posts',
            'delete-blog-posts',
        ]);*/

        /*$customerRole->givePermissionTo([
            'create-blog-posts',
            'edit-blog-posts',
            'delete-blog-posts',
        ]);*/
    }
}
