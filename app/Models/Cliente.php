<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ClienteResetPasswordNotification;
use App\Notifications\ClienteVerifyEmail;
use App\Notifications\ClienteCreateEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'cliente';

    protected $fillable = ['name', 'email', 'password', 'cpf', 'genero_id', 'data_nascimento', 'ativo'];

    public function enderecos() {
        return $this->hasMany('App\Models\ClienteEndereco');
    }

    public function genero() {
        return $this->belongsTo('App\Models\Genero');
    }

    public function telefones() {
        return $this->hasMany('App\Models\ClienteTelefone');
    }

    public function pets() {
        return $this->hasMany('App\Models\Pet');
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

    public function sendClienteCreateNotification($cliente, $password) 
    {
        $this->notify(new ClienteCreateEmail($cliente, $password));
    }
}
