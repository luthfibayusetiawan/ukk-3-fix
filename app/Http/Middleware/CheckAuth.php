<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuth
{
    public function handle(Request $request, Closure $next, ?string $role = null)
    {
        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        if ($role && session('role') !== $role) {
            return redirect()->route('login');
        }
        
        return $next($request);
    }
}