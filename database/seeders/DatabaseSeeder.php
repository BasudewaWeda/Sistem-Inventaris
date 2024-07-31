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
        // Create permission groups
        $permissionGroups = [
            ['permission_group_name' => 'inventaris', 'alias' => 'Inventaris'],
            ['permission_group_name' => 'pemindahan-inventaris', 'alias' => 'Pemindahan Inventaris'],
            ['permission_group_name' => 'user-management', 'alias' => 'User Management'],
            ['permission_group_name' => 'role-management', 'alias' => 'Role Management'],
            ['permission_group_name' => 'kantor-management', 'alias' => 'Kantor Management'],
        ];

        foreach ($permissionGroups as $permissionGroupData) {
            PermissionGroup::create($permissionGroupData);
        }

        // Create permissions
        $permissions = [
            ['permission_name' => 'inventaris', 'alias' => 'Inventaris', 'permission_group_id' => 1],
            ['permission_name' => 'add-inventaris', 'alias' => 'Add Inventaris', 'permission_group_id' => 1],
            ['permission_name' => 'ubah-status-inventaris', 'alias' => 'Ubah Status Inventaris', 'permission_group_id' => 1],
            ['permission_name' => 'approval-inventaris', 'alias' => 'Approval Inventaris', 'permission_group_id' => 1],
            ['permission_name' => 'pemindahan-inventaris', 'alias' => 'Pemindahan Inventaris', 'permission_group_id' => 2],
            ['permission_name' => 'add-pemindahan-inventaris', 'alias' => 'Add Pemindahan Inventaris', 'permission_group_id' => 2],
            ['permission_name' => 'ubah-status-pemindahan-inventaris', 'alias' => 'Ubah Status Pemindahan Inventaris', 'permission_group_id' => 2],
            ['permission_name' => 'approval-pemindahan-inventaris', 'alias' => 'Approval Pemindahan Inventaris', 'permission_group_id' => 2],
            ['permission_name' => 'user', 'alias' => 'User', 'permission_group_id' => 3],
            ['permission_name' => 'add-user', 'alias' => 'Add User', 'permission_group_id' => 3],
            ['permission_name' => 'edit-user', 'alias' => 'Edit User', 'permission_group_id' => 3],
            ['permission_name' => 'delete-user', 'alias' => 'Delete User', 'permission_group_id' => 3],
            ['permission_name' => 'role', 'alias' => 'Role', 'permission_group_id' => 4],
            ['permission_name' => 'add-role', 'alias' => 'Add Role', 'permission_group_id' => 4],
            ['permission_name' => 'edit-role', 'alias' => 'Edit Role', 'permission_group_id' => 4],
            ['permission_name' => 'delete-role', 'alias' => 'Delete Role', 'permission_group_id' => 4],
            ['permission_name' => 'kantor', 'alias' => 'Kantor', 'permission_group_id' => 5],
            ['permission_name' => 'add-kantor', 'alias' => 'Add Kantor', 'permission_group_id' => 5],
            ['permission_name' => 'edit-kantor', 'alias' => 'Edit Kantor', 'permission_group_id' => 5],
            ['permission_name' => 'delete-kantor', 'alias' => 'Delete Kantor', 'permission_group_id' => 5],
        ];

        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }

        // Create roles
        $roleAdmin = Role::create(['role_name' => 'Admin']);
        $roleUser = Role::create(['role_name' => 'User']);

        // Attach permissions to roles
        $roleAdmin->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]); // Attach all permissions to admin
        $roleUser->permissions()->attach([1, 2, 3, 5, 6, 7]); // Attach view-post permission to user

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
