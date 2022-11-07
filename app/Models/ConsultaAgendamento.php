<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultaAgendamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['pet_id','veterinario_id','data_consulta','horario_consulta','relatorio','valor','status_id'];

    public function pet() {
        return $this->belongsTo('App\Models\Pet')->withTrashed();
    }

    public function veterinario() {
        return $this->belongsTo('App\Models\Veterinario')->withTrashed();
    }

    public function status() {
        return $this->belongsTo('App\Models\Status')->withTrashed();
    }
}
