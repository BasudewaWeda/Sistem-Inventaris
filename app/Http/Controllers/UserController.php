<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUser() {
        $addUser = Role::checkPermission('Add User');
        $editUser = Role::checkPermission('Edit User');
        $deleteUser = Role::checkPermission('Delete User');

        $users = User::getUsers();
        return view('user.index', compact('addUser', 'editUser', 'deleteUser', 'users'));
    }

    public function showAddUser() {
        $roles = Role::getRoleRecords();
        return view('user.add', compact('roles'));
    }

    public function addUser(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users',
            'user_name' => 'required|string|max:255',
            'user_phone_number' => 'required|string|max:255',
            'role_ids' => 'required|array|min:1',
        ]);

        User::createUser($request->all());

        return redirect('/user-management')->with('success', 'New user created');
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
            'email' => 'required|email|unique:user',
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
