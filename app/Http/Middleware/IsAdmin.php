<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isAdmin()) {
            Log::warning('Non-admin user attempted to access admin area', [
                'user_id' => auth()->id(),
                'route' => $request->route()->getName()
            ]);
            abort(403, 'Unauthorized. This action requires admin privileges.');
        }

        return $next($request);
    }
}
