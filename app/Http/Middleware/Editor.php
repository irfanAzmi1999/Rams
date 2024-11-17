<?php

namespace App\Http\Middleware;

use Closure;

class Editor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $editor = ['PENTADBIR SISTEM', 'PENTADBIR KKR', 'PENTADBIR JKR', 'JKR NEGERI', 'JKR DAERAH'];
        
        if (!in_array($request->user()->role->name, $editor)) {
            return redirect('/dashboard')->with('statusdanger', 'Capaian akses anda tidak dibenarkan!');
        }
        return $next($request);
    }
}
