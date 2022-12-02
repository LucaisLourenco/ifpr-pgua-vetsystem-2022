<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['nome'];

    public function consultaagendamentos() {
        return $this->hasMany('App\Models\ConsultaAgendamento');
    }

    public function servicoagendamentos() {
        return $this->hasMany('App\Models\ServicoAgendamento');
    }
}
