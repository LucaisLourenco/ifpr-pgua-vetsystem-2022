<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaAgendamento extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id','veterinario_id','data_agendamento','data_consulta','status'];

}
