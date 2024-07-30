<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission_check): Response
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $user_current_role = Auth::user()->currentRole;

        // dd($permission);

        // dd($user_current_role->permissions);

        foreach ($user_current_role->permissions as $permission) {
            // permission_name = slug
            // dd($permission->permission_name);
            if ($permission->permission_name == $permission_check) {
                return $next($request);
            }
        }

        return abort(403, 'Unauthorized');
    }
}
