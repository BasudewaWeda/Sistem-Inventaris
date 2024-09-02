<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Rules\Recaptcha;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // \Log::debug(print_r($this->request->all(), true));
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'g-recaptcha-response' => ['required', new Recaptcha],
        ];
    }

    public function messages() {
        return [
            'email.required' => 'The email field is required',
            'email.email' => 'Please provide a valid email address',
            'password.required' => 'The password field is required',
            'g-recaptcha-response.required' => 'Please complete the CAPTCHA',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('email', $this->email)->first();

        if (!$user || $user->status !== 'active') {
            throw ValidationException::withMessages([
                'email' => 'Your account has been temporarily blocked due to multiple failed login attempts. Please contact administrator.',
            ]);
        }

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {

            $user->increment('failed_attempts');

            if ($user->failed_attempts >= 3) {
                $user->update([
                    'status' => 'inactive',
                    'failed_attempts' => 0,
                ]);
            }
            
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);

            RateLimiter::hit($this->throttleKey());
        }

        $user->update(['failed_attempts' => 0]);

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
