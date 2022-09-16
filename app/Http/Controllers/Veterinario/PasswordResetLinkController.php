<?php

namespace App\Http\Controllers\Veterinario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Veterinario;
use Illuminate\Support\Facades\DB;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('veterinario.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        if(DB::table('veterinarios')->where('email', $request->email)->exists()) {
            $user = Veterinario::where('email', request()->input('email'))->first();
            $token = Password::getRepository()->create($user);
            $user->sendPasswordResetNotification($token);
            $status = "link-enviado";
        }  else {
            $status = "link-nao-enviado";
        }

        return back()->with('status', $status);
    }
}
