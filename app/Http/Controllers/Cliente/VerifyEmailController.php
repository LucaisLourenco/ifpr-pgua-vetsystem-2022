<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user('cliente')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('cliente')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('cliente')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('cliente')->markEmailAsVerified()) {
            event(new Verified($request->user('cliente')));
        }

        return redirect()->intended(RouteServiceProvider::HOME_CLIENTE.'?verified=1');
    }
}
