<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeterinarioTelefone extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'numero', 'veterinario_id'];

    public function veterinario() {
        return $this->belongsTo('App\Models\Veterinario');
    }
}
