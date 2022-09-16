<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user('cliente')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME_CLIENTE);
        }

        $request->user('cliente')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
