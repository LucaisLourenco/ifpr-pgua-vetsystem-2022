<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
        
                switch ($guard) {
                    case 'cliente':
                        if(Auth::guard($guard)->check()){
                            return redirect()->route('templatescliente.main');
                        }
                        break;

                    case 'veterinario':
                        if(Auth::guard($guard)->check()){
                            return redirect()->route('templatesveterinario.main');
                        }
                        break;  

                    default:
                        if(Auth::guard($guard)->check()){
                            return redirect()->route('templates.main');
                        }
                        break;
                }
            }
        }

        return $next($request);
    }
}


