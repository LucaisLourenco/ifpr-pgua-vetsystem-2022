<?php

namespace App\Http\Controllers\Veterinario;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user('veterinario')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME_VETERINARIO);
        }

        $request->user('veterinario')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
