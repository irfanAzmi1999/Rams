<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Illuminate\Http\Response  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // List of allowed admin roles
        $adminRoles = ['PENTADBIR SISTEM', 'PENTADBIR KKR'];

        // Check if the user is authenticated and has the right role
        if (!$request->user() || !in_array($request->user()->role->name, $adminRoles)) {
            return redirect('/dashboard')->with('statusdanger', 'Capaian akses anda tidak dibenarkan!');
        }

        // Allow request to proceed
        return $next($request);
    }
}
