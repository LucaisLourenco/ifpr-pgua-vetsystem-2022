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
                            return redirect('WebCliente');
                        }
                        break;

                    case 'veterinario':
                        if(Auth::guard($guard)->check()){
                            return redirect('WebVeterinario');
                        }
                        break;  

                    default:
                        if(Auth::guard($guard)->check()){
                            return redirect()->route('sistema');
                        }
                        break;
                }
            }
        }

        return $next($request);
    }
}


