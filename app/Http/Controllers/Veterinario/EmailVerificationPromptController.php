<?php

namespace App\Http\Controllers\Veterinario;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user('veterinario')->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME_VETERINARIO)
                    : view('veterinario.verify-email');
    }
}
