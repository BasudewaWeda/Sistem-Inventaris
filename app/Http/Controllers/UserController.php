<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
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
            'email' => 'required|email|unique:users|max:255',
            'user_name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $slug = Str::slug($value);
        
                    // Query to check if the slug already exists
                    $exists = DB::table('users')
                        ->where('slug', $slug)
                        ->exists();
        
                    if ($exists) {
                        $fail('User name already taken');
                    }
                },
            ],
            'user_phone_number' => 'required|string|max:13|min:10|regex:/^08[1-9][0-9]{7,10}$/|unique:users',
            'role_ids' => 'required|array|min:1',
        ], [
            'role_ids.required' => 'Select at least one role',
            'role_ids.min' => 'Select at least one role'
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
                'max:255',
                Rule::unique('users')->ignore($user->user_id, 'user_id'),
            ],
            'user_name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($user) {
                    $slug = Str::slug($value);
        
                    // Query to check if the slug already exists, excluding the current user ID
                    $exists = DB::table('users')
                        ->where('slug', $slug)
                        ->where(function ($query) use ($user) {
                            if ($user) {
                                $query->where('user_id', '!=', $user->user_id);
                            }
                        })
                        ->exists();
        
                    if ($exists) {
                        $fail('User name already taken');
                    }
                },
            ],    
            'user_phone_number' => [
                'required',
                'string',
                'max:13',
                'min:10',
                'regex:/^08[1-9][0-9]{7,10}$/',
                Rule::unique('users')->ignore($user->user_id, 'user_id'),
            ],
            'role_ids' => 'required|array|min:1',
            'status' => 'required|string|in:active,inactive'
        ], [
            'role_ids.required' => 'Select at least one role',
            'role_ids.min' => 'Select at least one role'
        ]);

        try {
            $user->updateUser($request->all());

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

    public function resetUserPassword(User $user) {
        $user->resetPassword();

        Alert::toast('User password reset');

        return redirect('/user-management')->with('success', 'User password reset');
    }
}
