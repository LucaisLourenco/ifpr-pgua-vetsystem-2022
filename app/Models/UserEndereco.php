<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEndereco extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cep', 'rua', 'numero', 'complemento', 
        'bairro', 'cidade', 'uf', 'user_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
