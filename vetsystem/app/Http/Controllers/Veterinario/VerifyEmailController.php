<?php

namespace App\Http\Controllers\Veterinario;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user('veterinario')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('veterinario')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('veterinario')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('veterinario')->markEmailAsVerified()) {
            event(new Verified($request->user('veterinario')));
        }

        return redirect()->intended(RouteServiceProvider::HOME_VETERINARIO.'?verified=1');
    }
}
