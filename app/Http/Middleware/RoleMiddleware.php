<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Ви повинні авторизуватись.');
        }

        $user = Auth::user();

        $rolesArray = explode('|', $role);
        if (!in_array($user->role, $rolesArray)) {
            return redirect('errors/401');
        }

        return $next($request);
    }
}
