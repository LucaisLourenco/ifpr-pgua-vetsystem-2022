<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('cliente.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        if(DB::table('clientes')->where('email', $request->email)->exists()) {
            $user = Cliente::where('email', request()->input('email'))->first();
            $token = Password::getRepository()->create($user);
            $user->sendPasswordResetNotification($token);
            $status = "link-enviado";
        }  else {
            $status = "link-nao-enviado";
        }

        return back()->with('status', $status);
    }
}
