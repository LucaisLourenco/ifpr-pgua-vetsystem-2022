<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecoVeterinario extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cep', 'rua', 'numero', 'complemento', 
        'bairro', 'cidade', 'uf', 'veterinario_id'];

    public function veterinario() {
        return $this->belongsTo('App\Models\Veterinario');
    }
}
