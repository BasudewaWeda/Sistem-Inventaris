<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Rules\Recaptcha;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\ValidationException;

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

        $user->updateCurrentRole($request->all());

        Alert::toast('Role changed');
        
        return redirect('/profile')->with('success', 'Role updated');
    }

    public function updatePassword(Request $request) {
        $request = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string',
            'confirm_password' => 'required|string',
        ]);

        $user = User::getCurrentUser();

        if (!Hash::check($request['current_password'], $user->password)) {
            Alert::toast('Current password incorrect');

            return redirect('/profile')->withError(['current_password' => 'Current password incorrect']);
        }

        if ($request['new_password'] != $request['confirm_password']) {
            Alert::toast('New password and confirm password must be the same');

            return redirect('/profile')->withError(['new_password', 'New password and confirm password must be the same']);
        }

        $user->updatePassword($request);

        Alert::toast('Password changed');
        
        return redirect('/profile')->with('success', 'Password updated');
    }

    public function showForgotPasswordForm() {
        return view('reset-password.forgot-password');
    }

    public function forgotPassword(Request $request) {
        $request = $request->validate([
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response' => ['required', new Recaptcha],
        ], [
            'email.exists' => 'Email is not in the system',
            'g-recaptcha-response.required' => 'Please complete the CAPTCHA',
        ]);

        $user = User::where('email', $request['email'])->first();
        $sameDay = false;

        if (!empty($user->forget_code_request_date)) {
            $sameDay = Carbon::parse($user->forget_code_request_date)->isSameDay(Carbon::now());
        }

        if ($user->forget_code_request_amount >= 3 && $sameDay) {
            throw ValidationException::withMessages([
                'email' => 'You have reached the limit of 3 forget code requests for today. Please try again tomorrow.',
            ]);
        }
        else {
            $user->forgotPassword($request['email'], $sameDay);
        }

        return redirect('/reset-password');
    }

    public function showResetPasswordForm() {
        return view('reset-password.reset-password');
    }

    public function resetPassword(Request $request) { // User forgot and reset password
        $request = $request->validate([
            'email' => 'required|exists:users,email|email',
            'forget_code' => 'required|string',
            'new_password' => 'required|string|confirmed|min:8',
            'new_password_confirmation' => 'required|string|min:8',
        ]);

        $result = User::resetForgotPassword($request);

        if (is_array($result) && isset($result['status']) && $result['status'] === 'fail') {
            return redirect()->back()->withErrors(['forget_code' => $result['message']])->withInput();
        }

        return redirect('/login');
    }
}
