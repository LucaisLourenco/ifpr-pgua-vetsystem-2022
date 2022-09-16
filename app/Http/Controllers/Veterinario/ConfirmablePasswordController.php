<?php

namespace App\Http\Controllers\Veterinario;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{
    public function show()
    {
        return view('veterinario.confirm-password');
    }

    public function store(Request $request)
    {
        if (! Auth::guard('veterinario')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('veterinario.password'),
            ]);
        }

        $request->session()->put('veterinario.password_confirmed_at', time());

        return redirect()->intended(RouteServiceProvider::HOME_VETERINARIO);
    }
}
