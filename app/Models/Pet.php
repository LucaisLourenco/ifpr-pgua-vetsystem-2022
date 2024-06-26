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

    public function pesos() {
        return $this->hasMany('App\Models\Peso');
    }

    public function obs() {
        return $this->hasMany('App\Models\PetObservacao');
    }

    public function consultas() {
        return $this->hasMany('App\Models\ConsultaAgendamento');
    }

    public function servicos() {
        return $this->hasMany('App\Models\ServicoAgendamento');
    }
}
