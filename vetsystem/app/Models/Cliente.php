<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ClienteResetPasswordNotification;
use App\Notifications\ClienteVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'cliente';

    protected $fillable = ['name', 'email', 'password', 'cpf', 'genero_id', 'data_nascimento', 'ativo'];

    public function endereco() {
        return $this->hasMany('App\Models\Endereco');
    }

    public function telefone() {
        return $this->hasMany('App\Models\Telefone');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClienteResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new ClienteVerifyEmail);
    }
}
