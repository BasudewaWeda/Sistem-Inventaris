<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }
        
        $currentUser = Auth::user();
        
        if ($currentUser->has_changed_password == 0) {
            Alert::toast('Please change your password');

            return redirect('/profile');
        }
        
        $user_current_role = $currentUser->currentRole;
        
        foreach ($permissions as $permission_check) {
            foreach ($user_current_role->permissions as $permission) {
                // permission_name = slug
                if ($permission->permission_name == $permission_check) {
                    return $next($request);
                }
            }
        }
        
        return abort(403, 'Unauthorized');
    }
}
