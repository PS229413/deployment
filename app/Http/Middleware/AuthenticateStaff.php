<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateStaff
{
    public function handle(Request $request, Closure $next)
    {
        $staff = Auth::guard('staff')->user();

        if (!$staff || $staff->role !== 'Admin') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
