<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    // ambil nama role dari relasi role
    $roleName = $user->role ? $user->role->name : null;

    // cek apakah role ada di list yang diizinkan
    if (!$roleName || !in_array($roleName, $roles)) {
        abort(403, 'Unauthorized.');
    }

        return $next($request);
    }
}
