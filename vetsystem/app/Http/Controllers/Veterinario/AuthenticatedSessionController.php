<?php

namespace App\Http\Controllers\Veterinario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Veterinario\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('veterinario.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME_VETERINARIO);
    }

    public function destroy(Request $request)
    {
        Auth::guard('veterinario')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('veterinario.login');
    }
}
