<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeterinarioEspecialidade extends Model
{
    use HasFactory;

    protected $fillable = ['veterinario_id', 'especialidade_id'];

    public function especialidade() {
        return $this->belongsTo('\App\Models\Especialidade');
    }

    public function veterinario() {
        return $this->belongsTo('\App\Models\Veterinario');
    }
}
