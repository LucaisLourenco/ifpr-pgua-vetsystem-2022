<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ClienteEmailIsVerified
{
    public function handle($request, Closure $next,  $redirectToRoute = null)
    {
        if (!$request->user('cliente') ||
            ($request->user('cliente') instanceof MustVerifyEmail &&
                !$request->user('cliente')->hasVerifiedEmail())) {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route($redirectToRoute ?: 'cliente.verification.notice');
        }

        return $next($request);
    }
}
