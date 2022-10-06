<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory, SoftDeletes;
   
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['nome', 'data_nascimento', 'cliente_id', 'sexo_id', 'raca_id', 'ativo'];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente')->withTrashed();
    }

    public function raca() {
        return $this->belongsTo('App\Models\Raca')->withTrashed();
    }

    public function sexo() {
        return $this->belongsTo('App\Models\Sexo')->withTrashed();
    }
}
