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
                        $path = 'cliente';
                        break;

                    case 'veterinario':
                        $path = 'veterinario';
                        break;  

                    default:
                        $path = 'sistema';
                        break;
                }

                return redirect($path);
            }
        }

        return $next($request);
    }
}


