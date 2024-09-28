<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRoleWithConditions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        $user = Auth::user();

        // Check if user has the required role
        if (!$user || !$user->hasRole($role)) {
            abort(403, 'Unauthorized');
        }

        // Add your custom conditions here (e.g., check region, status, etc.)
        if ($user->region_id != $request->route('region_id')) {
            abort(403, 'Unauthorized: Incorrect region.');
        }
        
        

        // You can apply more conditions as needed
        return $next($request);
    }
}
