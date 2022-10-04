<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    
    protected $fillable = ['nome', 'data_nascimento', 'cliente_id', 'sexo_id', 'raca_id', 'ativo'];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function raca() {
        return $this->belongsTo('App\Models\Raca');
    }

    public function sexo() {
        return $this->belongsTo('App\Models\Sexo');
    }
}
