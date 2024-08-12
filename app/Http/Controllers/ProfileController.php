<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // /**
    //  * Display the user's profile form.
    //  */
    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }

    // /**
    //  * Update the user's profile information.
    //  */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    // /**
    //  * Delete the user's account.
    //  */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }

    public function profile() {
        $currentUser = User::getCurrentUser();

        return view('profile.edit', compact('currentUser'));
    }

    public function updateRole(Request $request) {
        $user = User::getCurrentUser();

        $request->validate([
            'role' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!$user->roles->pluck('role_id')->contains($value)) {
                        $fail('The selected role is invalid.');
                    }
                },
            ],
        ]);

        User::updateCurrentRole($user, $request->all());

        Alert::toast('Role changed');
        
        return redirect('/profile')->with('success', 'Role updated');
    }

    public function updatePassword(Request $request) {
        $user = User::getCurrentUser();

        if (!Hash::check($request['current_password'], $user->password)) {
            Alert::toast('Password incorrect');

            return redirect('/profile')->withError(['current_password' => 'Incorrect password']);
        }

        if ($request['new_password'] != $request['confirm_password']) {
            Alert::toast('New password and confirm password must be the same');

            return redirect('/profile')->withError(['new_password', 'New password and confirm password must be the same']);
        }

        User::updatePassword($user, $request->all());

        Alert::toast('Password changed');
        
        return redirect('/profile')->with('success', 'Password updated');
    }
}
