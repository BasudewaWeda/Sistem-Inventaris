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
            ['permission_name' => 'view-inventaris', 'alias' => 'View Inventaris', 'permission_group_id' => 1],
            ['permission_name' => 'input-inventaris', 'alias' => 'Input Inventaris', 'permission_group_id' => 1],
            ['permission_name' => 'ubah-status-inventaris', 'alias' => 'Ubah Status Inventaris', 'permission_group_id' => 1],
            ['permission_name' => 'view-approval-inventaris', 'alias' => 'View Approval Inventaris', 'permission_group_id' => 1],
            ['permission_name' => 'approval-inventaris-1', 'alias' => 'Approval Inventaris 1', 'permission_group_id' => 1],
            ['permission_name' => 'approval-inventaris-2', 'alias' => 'Approval Inventaris 2', 'permission_group_id' => 1],
            ['permission_name' => 'view-pemindahan-inventaris', 'alias' => 'View Pemindahan Inventaris', 'permission_group_id' => 2],
            ['permission_name' => 'add-pemindahan-inventaris', 'alias' => 'Add Pemindahan Inventaris', 'permission_group_id' => 2],
            ['permission_name' => 'ubah-status-pemindahan-inventaris', 'alias' => 'Ubah Status Pemindahan Inventaris', 'permission_group_id' => 2],
            ['permission_name' => 'view-approval-pemindahan-inventaris', 'alias' => 'View Approval Pemindahan Inventaris', 'permission_group_id' => 2],
            ['permission_name' => 'approval-pemindahan-inventaris-1', 'alias' => 'Approval Pemindahan Inventaris 1', 'permission_group_id' => 2],
            ['permission_name' => 'approval-pemindahan-inventaris-2', 'alias' => 'Approval Pemindahan Inventaris 2', 'permission_group_id' => 2],
            ['permission_name' => 'view-user', 'alias' => 'View User', 'permission_group_id' => 3],
            ['permission_name' => 'add-user', 'alias' => 'Add User', 'permission_group_id' => 3],
            ['permission_name' => 'edit-user', 'alias' => 'Edit User', 'permission_group_id' => 3],
            ['permission_name' => 'delete-user', 'alias' => 'Delete User', 'permission_group_id' => 3],
            ['permission_name' => 'view-role', 'alias' => 'View Role', 'permission_group_id' => 4],
            ['permission_name' => 'add-role', 'alias' => 'Add Role', 'permission_group_id' => 4],
            ['permission_name' => 'edit-role', 'alias' => 'Edit Role', 'permission_group_id' => 4],
            ['permission_name' => 'delete-role', 'alias' => 'Delete Role', 'permission_group_id' => 4],
            ['permission_name' => 'view-kantor', 'alias' => 'View Kantor', 'permission_group_id' => 5],
            ['permission_name' => 'add-kantor', 'alias' => 'Add Kantor', 'permission_group_id' => 5],
            ['permission_name' => 'edit-kantor', 'alias' => 'Edit Kantor', 'permission_group_id' => 5],
            ['permission_name' => 'delete-kantor', 'alias' => 'Delete Kantor', 'permission_group_id' => 5],
        ];

        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }

        // Create roles
        $roleAdmin = Role::create(['role_name' => 'Super Admin', 'slug' => 'admin']);
        $roleUser = Role::create(['role_name' => 'User', 'slug' => 'user']);
        $roleKepalaBagian = Role::create(['role_name' => 'Kepala Bagian', 'slug' => 'kepala-bagian']);
        $roleKepalaDivisi = Role::create(['role_name' => 'Kepala Divisi', 'slug' => 'kepala-divisi']);

        // Attach permissions to roles
        $roleAdmin->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]);
        $roleUser->permissions()->attach([1, 2, 3, 7]);
        $roleKepalaBagian->permissions()->attach([3, 6, 12]);
        $roleKepalaDivisi->permissions()->attach([3, 5, 11]);

        // Create user
        $user = User::create([
            'user_name' => 'Admin',
            'slug' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'user_phone_number' => '08123456789',
            'current_role_id' => $roleAdmin->role_id,
        ]);

        // Attach roles to user
        $user->roles()->attach($roleAdmin);

        // Create another user
        $user = User::create([
            'user_name' => 'User',
            'slug' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'user_phone_number' => '08123456789',
            'current_role_id' => $roleUser->role_id,
            'creator_id' => 1,
        ]);

        // Attach roles to user
        $user->roles()->attach($roleUser);

        $user = User::create([
            'user_name' => 'John Doe',
            'slug' => 'john-doe',
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('password'),
            'user_phone_number' => '08123456789',
            'current_role_id' => $roleKepalaBagian->role_id,
            'creator_id' => 1,
        ]);

        $user->roles()->attach($roleKepalaBagian);

        $user = User::create([
            'user_name' => 'John Doe 2',
            'slug' => 'john-doe-2',
            'email' => 'johndoe2@gmail.com',
            'password' => Hash::make('password'),
            'user_phone_number' => '08123456789',
            'current_role_id' => $roleKepalaBagian->role_id,
            'creator_id' => 1,
        ]);

        $user->roles()->attach($roleKepalaBagian);
        
        $user = User::create([
            'user_name' => 'Jane Doe',
            'slug' => 'jane-doe',
            'email' => 'janedoe@gmail.com',
            'password' => Hash::make('password'),
            'user_phone_number' => '08123456789',
            'current_role_id' => $roleKepalaDivisi->role_id,
            'creator_id' => 1,
        ]);

        $user->roles()->attach($roleKepalaDivisi);

        $user = User::create([
            'user_name' => 'Jane Doe 2',
            'slug' => 'jane-doe-2',
            'email' => 'janedoe2@gmail.com',
            'password' => Hash::make('password'),
            'user_phone_number' => '08123456789',
            'current_role_id' => $roleKepalaDivisi->role_id,
            'creator_id' => 1,
        ]);

        $user->roles()->attach($roleKepalaDivisi);

        // Other seeders
        $this->call([
            ProvinsiKabupatenSeeder::class,
            KantorSeeder::class,
            InventarisSeeder::class,
        ]);
    }
}
