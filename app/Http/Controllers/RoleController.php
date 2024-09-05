<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function showRole() {
        $addRole = Role::checkPermission('add-role');
        $editRole = Role::checkPermission('edit-role');
        $deleteRole = Role::checkPermission('delete-role');

        $title = 'Delete Role';
        $text = "Are you sure you want to delete role?";
        confirmDelete($title, $text);

        $roles = Role::getRoles();
        return view('role.index', compact('addRole', 'editRole', 'deleteRole', 'roles'));
    }
    
    public function showAddRole() {
        $permissionGroups = PermissionGroup::getPermissionGroups();
        return view('role.add', compact('permissionGroups'));
    }

    public function addRole(Request $request) {
        $request->validate([
            'role_name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $slug = Str::slug($value);
        
                    // Query to check if the slug already exists
                    $exists = DB::table('roles')
                        ->where('slug', $slug)
                        ->exists();
        
                    if ($exists) {
                        $fail('Role name already in system');
                    }
                },
            ],
            'permission_ids' => 'required|array|min:1',
        ], [
            'role_name.unique' => 'Role name already in system',
            'permission_ids.required' => 'Select at least one permission',
            'permission_ids.min' => 'Select at least one permission',
        ]);

        Role::createRole($request->all());

        Alert::toast('Role created');

        return redirect('/role-management')->with('success', 'New role created');
    }

    public function showEditRole(Role $role) {
        if(!$role) return redirect('/role-management')->with('error', 'Role not found');

        $permissionGroups = PermissionGroup::getPermissionGroups();
        $role_permissions = $role->permissions;

        return view('role.edit', compact('role', 'role_permissions', 'permissionGroups'));
    }

    public function editRole(Role $role, Request $request) {
        $request->validate([
            'role_name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($role) {
                    $slug = Str::slug($value);
        
                    // Query to check if the slug already exists, excluding the current role ID
                    $exists = DB::table('roles')
                        ->where('slug', $slug)
                        ->where(function ($query) use ($role) {
                            if ($role) {
                                $query->where('role_id', '!=', $role->role_id);
                            }
                        })
                        ->exists();
        
                    if ($exists) {
                        $fail('Role name already in system');
                    }
                },
            ],    
            'permission_ids' => 'required|array|min:1',
        ], [
            'role_name.unique' => 'Role name already in system',
            'permission_ids.required' => 'Select at least one permission',
            'permission_ids.min' => 'Select at least one permission',
        ]);

        try {
            $role->updateRole($request->all());

            Alert::toast('Role updated');

            return redirect('/role-management')->with('success', 'Role updated');
        }
        catch (Exception $e) {
            return redirect('/role-management')->with('error', $e->getMessage());
        }
    }

    public function deleteRole(Role $role) {
        $role->delete();

        Alert::toast('Role deleted');

        return redirect('/role-management')->with('success', 'Role deleted');
    }
}
