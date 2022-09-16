<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VeterinarioEmailIsVerified
{
    public function handle($request, Closure $next,  $redirectToRoute = null)
    {
        if (!$request->user('veterinario') ||
            ($request->user('veterinario') instanceof MustVerifyEmail &&
                !$request->user('veterinario')->hasVerifiedEmail())) {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route($redirectToRoute ?: 'veterinario.verification.notice');
        }

        return $next($request);
    }
}

