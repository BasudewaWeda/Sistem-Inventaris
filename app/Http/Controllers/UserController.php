<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUser() {
        if (!(Role::checkPermission('User'))) abort(401);

        $addUser = Role::checkPermission('Add User');
        $editUser = Role::checkPermission('Edit User');
        $deleteUser = Role::checkPermission('Delete User');

        $users = User::getUsers();
        return view('panel.user.list', compact('addUser', 'editUser', 'deleteUser', 'users'));
    }

    public function showAddUser() {
        if (!(Role::checkPermission('Add User'))) abort(401);

        $roles = Role::getRoleRecords();
        return view('panel.user.add', compact($roles));
    }

    public function addUser(Request $request) {
        if (!(Role::checkPermission('Add User'))) abort(401);

        $request->validate([
            'user_email' => 'required|email|unique:user',
            'user_name' => 'required|string|max:255',
            'user_phone_number' => 'required|string|max:255',
            'user_password' => 'required|string|min:8',
            'role_ids' => 'required|array|min:1',
        ]);

        User::createUser($request->all());

        return redirect('panel/user')->with('success', 'New user created');
    }

    public function showEditUser($id) {
        if (!(Role::checkPermission('Edit User'))) abort(401);

        $edited_user = User::getSingleUser($id);

        if(!$edited_user) return redirect('panel/user')->with('error', 'User not found');

        $roles = Role::getRoleRecords();
        $edited_user_roles = $edited_user->roles;

        return view('panel.user.edit', compact('edited_user', 'edited_user_roles', 'roles'));
    }

    public function updateUser($id, Request $request) {
        if (!(Role::checkPermission('Edit User'))) abort(401);

        $request->validate([
            'user_email' => 'required|email|unique:user',
            'user_name' => 'required|string|max:255',
            'user_phone_number' => 'required|string|max:255',
            'role_ids' => 'required|array|min:1',
        ]);

        try {
            User::updateUser($id, $request->all());
            return redirect('panel/user')->with('success', 'User updated');
        }
        catch (Exception $e) {
            return redirect('panel/user')->with('error', $e->getMessage());
        }
    }
}
