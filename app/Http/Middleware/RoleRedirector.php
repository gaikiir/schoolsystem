<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $role = strtolower(Auth::user()->role);

        if ($role === 'admin') {
            return redirect()->route('admindash');
        } elseif ($role === 'user') {
            return redirect()->route('user.dashboard');
        }

        // If the role is not recognized, abort with 403
        abort(403, 'Not Authorized');
        return $next($request);
    }
}
