<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate 
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if($request->ajax()) {
                    return response('Unauthorized.',404);
                }
            }

            else {
                switch ($guard) {
                    case 'cliente':
                        $path = 'cliente/login';
                        break;

                    case 'veterinario':
                        $path = 'veterinario/login';
                        break;  

                    default:
                        $path = 'login';
                        break;
                }

                return redirect($path);
            }
        }

        return $next($request);
    }
}

