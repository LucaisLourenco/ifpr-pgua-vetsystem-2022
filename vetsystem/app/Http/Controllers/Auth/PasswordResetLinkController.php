<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status == "passwords.sent") {
            $status = "link-enviado";
        } 
        
        elseif($status == "passwords.throttled") {
            $status = "link-nao-enviado-aguarde";
        }
        
        else {
            $status = "link-nao-enviado";
        }

        return back()->with('status', $status);
    }
}
