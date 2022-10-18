<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VeterinarioResetPasswordNotification;
use App\Notifications\VeterinarioVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Veterinario extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $guard = 'veterinario';

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'crmv', 'email', 'password', 'cpf', 'genero_id', 'especialidade_id', 'data_nascimento', 'ativo'];

    public function especialidade() {
        return $this->belongsTo('App\Models\Especialidade')->withTrashed();
    }

    public function enderecos() {
        return $this->hasMany('App\Models\VeterinarioEndereco');
    }

    public function genero() {
        return $this->belongsTo('App\Models\Genero')->withTrashed();
    }

    public function telefones() {
        return $this->hasMany('App\Models\VeterinarioTelefone');
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
        $this->notify(new VeterinarioResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VeterinarioVerifyEmail);
    }
}
