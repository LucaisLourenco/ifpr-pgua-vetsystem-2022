<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user('cliente')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME_CLIENTE.'?verified=1');
        }

        if ($request->user('cliente')->markEmailAsVerified()) {
            event(new Verified($request->user('cliente')));
        }

        return redirect()->intended(RouteServiceProvider::HOME_CLIENTE.'?verified=1');
    }
}
