<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\PermissionGroup;
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
            'role_name' => 'required|string|max:30',
            'permission_ids' => 'required|array|min:1',
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
            'role_name' => 'required|string|max:30',
            'permission_ids' => 'required|array|min:1',
        ]);

        try {
            Role::updateRole($role, $request->all());

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
