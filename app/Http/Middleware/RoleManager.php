<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $roles=explode("|",$role);

        if (Auth::check()) {
            $user = Auth::user();
            if (in_array( $user->role, $roles)) {
                return $next($request);
            } else {
                if ($user->role == 0) {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role == 1) {
                    return redirect()->route('receiver.dashboard');
                } elseif ($user->role == 2) {
                    return redirect()->route('donor.dashboard');
                } else {
                    return url()->previous();
                }
            }
        } else {
            return redirect()->route('login')->with('error', 'You must login to continue.');
        }
    }
}
