<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function showRole() {
        if (!(Role::checkPermission('Role'))) abort(401);

        $addRole = Role::checkPermission('Add Role');
        $editRole = Role::checkPermission('Edit Role');

        $roles = Role::getRoles();
        return view('panel.role.list', compact('addRole', 'editRole', 'roles'));
    }
    
    public function showAddRole() {
        if (!(Role::checkPermission('Add Role'))) abort(401);

        $permissions = Permission::getRoleRecords();
        return view('panel.role.add', compact('permissions'));
    }

    public function addRole(Request $request) {
        if (!(Role::checkPermission('Add Role'))) abort(401);

        $request->validate([
            'role_name' => 'required|string|max:255',
            'permissions_ids' => 'required|array|min:1',
        ]);

        Role::createRole($request->all());

        return redirect('panel/role')->with('success', 'New user created');
    }

    public function showEditRole($id) {
        if (!(Role::checkPermission('Edit Role'))) abort(401);

        $edited_role = Role::getSingleRole($id);

        if(!$edited_role) return redirect('panel/role')->with('error', 'Role not found');

        $edited_role_permissions = $edited_role->permissions();
        $permissions = Permission::getRoleRecords();

        return view('panel.role.edit', compact('permissions', 'edited_roles', 'edited_roles_permissions'));
    }

    public function updateRole($id, Request $request) {
        if (!(Role::checkPermission('Edit Role'))) abort(401);

        $request->validate([
            'role_name' => 'required|string|max:255',
            'permissions_ids' => 'required|array|min:1',
        ]);

        try {
            Role::updateRole($id, $request->all());
            return redirect('panel/role')->with('success', 'Role updated');
        }
        catch (Exception $e) {
            return redirect('panel/role')->with('error', $e->getMessage());
        }
    }
}
