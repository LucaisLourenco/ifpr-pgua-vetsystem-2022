<?php

namespace App\Models;

use App\Notifications\UserCreateEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'email', 'password', 'cpf', 'genero_id', 'role_id', 'data_nascimento', 'ativo'];

    public function role() {
        return $this->belongsTo('App\Models\Role')->withTrashed();
    }

    public function enderecos() {
        return $this->hasMany('App\Models\UserEndereco');
    }

    public function genero() {
        return $this->belongsTo('App\Models\Genero')->withTrashed();
    }

    public function telefones() {
        return $this->hasMany('App\Models\UserTelefone');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendUserCreateNotification($user, $password) 
    {
        $this->notify(new UserCreateEmail($user, $password));
    }
}
