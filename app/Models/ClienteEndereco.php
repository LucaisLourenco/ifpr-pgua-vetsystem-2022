<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteEndereco extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cep', 'rua', 'numero', 'complemento', 
        'bairro', 'cidade', 'uf', 'cliente_id'];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente');
    }
}
