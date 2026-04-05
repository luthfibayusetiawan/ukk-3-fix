<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!session('logged_in')) {
            return redirect()->route('login');
        }
        
        if (session('role') !== $role) {
            abort(403, 'Unauthorized access');
        }
        
        return $next($request);
    }
}