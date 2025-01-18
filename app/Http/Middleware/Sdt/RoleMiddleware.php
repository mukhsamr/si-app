<?php

namespace App\Http\Middleware\Sdt;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->role === 'admin') {
            return $next($request);
        }

        if ($request->user()->role !== $role) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }
    }
}
