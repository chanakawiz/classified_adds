<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * Usage: 'role:admin', 'role:admin,editor'
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $userRole = (string) ($user->role ?? 'user');

        if (empty($roles)) {
            // If no roles specified, allow authenticated users
            return $next($request);
        }

        if (! in_array($userRole, $roles, true)) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}


