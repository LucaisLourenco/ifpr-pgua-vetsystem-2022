<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user('cliente')->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME_CLIENTE)
                    : view('cliente.verify-email');
    }
}
