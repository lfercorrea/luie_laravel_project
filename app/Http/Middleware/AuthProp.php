<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthProp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( !auth()->check() ) {
            return redirect(route('login'));
        }
        
        /**
         * inicialmente, a ideia é ter os seguintes nivels de permissão:
         * super administrador = level 1
         * administrador = level 2
         * usuario comum = level 3
         * outros usuarios (clientes, deslogados, etc) = level > 3
         */
        if ( auth()->user()->level > 1 ){
            return redirect(route('site.index'))
                ->with('fail', 'Suas credenciais não tem o nível de acesso suficiente para acessar este recurso.');
        }
        
        return $next($request);
    }
}
