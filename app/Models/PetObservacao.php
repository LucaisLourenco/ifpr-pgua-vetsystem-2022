<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetObservacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['tipo','descricao','pet_id','veterinario_id'];

    public function pet() {
        return $this->belongsTo('App\Models\Pet');
    }

    public function veterinario() {
        return $this->belongsTo('App\Models\Veterinario');
    }
}