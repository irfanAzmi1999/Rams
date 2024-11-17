<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $admin = ['PENTADBIR SISTEM', 'PENTADBIR KKR'];
        $pengguna = ['PENGGUNA SISTEM', 'TIDAK DIKETAHUI'];

        foreach ($roles as $role) {
            switch ($role) {
                case 'admin':
                    if (in_array($request->user()->role->name, $admin)) {
                        return $next($request);
                    }
                    break;
                case 'adminjkr':
                    if ($request->user()->role->name === 'PENTADBIR JKR') {
                        return $next($request);
                    }
                    break;
                case 'jkrnegeri':
                    if ($request->user()->role->name === 'JKR NEGERI') {
                        return $next($request);
                    }
                    break;
                case 'jkrdaerah':
                    if ($request->user()->role->name === 'JKR DAERAH') {
                        return $next($request);
                    }
                    break;
                case 'pengguna':
                    if (in_array($request->user()->role->name, $pengguna)) {
                        return $next($request);
                    }
                    break;
            }
        }

        return redirect('/dashboard')->with('statusdanger', 'Capaian akses anda tidak dibenarkan!');
    }
}
