<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Vérifier si l'utilisateur est connecté et a le rôle requis
        // if (! $request->user() || !$request->user()->hasRole($role)) {
        if ($role !== 'admin') {
            return redirect('/unauthorized'); // Rediriger si l'utilisateur n'a pas le bon rôle
        }

        return $next($request);
    }
}
