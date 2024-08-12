<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function showUser() {
        $addUser = Role::checkPermission('add-user');
        $editUser = Role::checkPermission('edit-user');
        $deleteUser = Role::checkPermission('delete-user');

        $users = User::getUsers();

        return view('user.index', compact('addUser', 'editUser', 'deleteUser', 'users'));
    }

    public function showAddUser() {
        $roles = Role::getRoles();
        return view('user.add', compact('roles'));
    }

    public function addUser(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users',
            'user_name' => 'required|string|max:40',
            'user_phone_number' => 'required|string|max:12',
            'role_ids' => 'required|array|min:1',
        ]);

        User::createUser($request->all());

        Alert::toast('User created');

        return redirect('/user-management')->with('success', 'New user created');
    }

    public function showEditUser(User $user) {
        if(!$user) return redirect('/user-management')->with('error', 'User not found');

        $roles = Role::getRoles();
        $user_roles = $user->roles;

        return view('user.edit', compact('user', 'user_roles', 'roles'));
    }

    public function editUser(User $user, Request $request) {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->user_id, 'user_id'),
            ],
            'user_name' => 'required|string|max:40',
            'user_phone_number' => 'required|string|max:12',
            'role_ids' => 'required|array|min:1',
        ]);

        try {
            User::updateUser($user, $request->all());

            Alert::toast('User updated');

            return redirect('/user-management')->with('success', 'User updated');
        }
        catch (Exception $e) {
            return redirect('/user-management')->with('error', $e->getMessage());
        }
    }

    public function deleteUser(User $user) {
        $user->delete();

        Alert::toast('User deleted');

        return redirect('/user-management')->with('success', 'User deleted');
    }
}
