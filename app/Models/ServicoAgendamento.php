<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicoAgendamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['pet_id','veterinario_id','servico_id','data_servico','horario_servico','relatorio','status_id'];

    public function pet() {
        return $this->belongsTo('App\Models\Pet')->withTrashed();
    }

    public function veterinario() {
        return $this->belongsTo('App\Models\Veterinario')->withTrashed();
    }

    public function status() {
        return $this->belongsTo('App\Models\Status')->withTrashed();
    }

    public function servico() {
        return $this->belongsTo('App\Models\Servico')->withTrashed();
    }
}
