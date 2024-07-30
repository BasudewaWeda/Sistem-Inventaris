<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $permissionGroup = PermissionGroup::create([
            'permission_group_name' => 'post-management',
            'alias' => 'Post Management'
        ]);

        // Create permissions
        $permissions = [
            ['permission_name' => 'create-post', 'alias' => 'Create Post', 'permission_group_id' => $permissionGroup->permission_group_id],
            ['permission_name' => 'edit-post', 'alias' => 'Edit Post', 'permission_group_id' => $permissionGroup->permission_group_id],
            ['permission_name' => 'delete-post', 'alias' => 'Delete Post', 'permission_group_id' => $permissionGroup->permission_group_id],
            ['permission_name' => 'view-post', 'alias' => 'View Post', 'permission_group_id' => $permissionGroup->permission_group_id],
        ];

        foreach ($permissions as $permissionData) {
            $permission = Permission::create($permissionData);
        }

        // Create roles
        $roleAdmin = Role::create(['role_name' => 'Admin']);
        $roleUser = Role::create(['role_name' => 'User']);

        // Attach permissions to roles
        $roleAdmin->permissions()->attach([1, 2, 3, 4]); // Attach all permissions to admin
        $roleUser->permissions()->attach([4]); // Attach view-post permission to user

        // Create user
        $user = User::create([
            'user_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'user_phone_number' => '12345',
            'current_role_id' => $roleAdmin->role_id
        ]);

        // Attach roles to user
        $user->roles()->attach($roleAdmin);

        // Create another user
        $user = User::create([
            'user_name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'user_phone_number' => '12345',
            'current_role_id' => $roleUser->role_id
        ]);

        // Attach roles to user
        $user->roles()->attach($roleUser);
    }
}
