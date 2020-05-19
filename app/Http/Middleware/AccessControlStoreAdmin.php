<?php

namespace App\Http\Middleware;

use Closure;

class AccessControlStoreAdmin
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
        //@TODO criar dela de "Esse usuario não tem permissão para esse conteudo"
        if(auth()->user()->role == 'ROLE_USER')
            return redirect()->route('home');

        return $next($request);
    }
}
