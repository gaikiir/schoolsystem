<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestrictUnapprovedUsers
{
    public function handle(Request $request, Closure $next)
    {
        //this for user approval by the admin
        if (Auth::check() && Auth::user()->status !== 'approved') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is not approved yet.');
        }

        return $next($request);
    }
}
