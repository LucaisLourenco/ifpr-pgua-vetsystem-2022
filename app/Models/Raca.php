<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raca extends Model
{
    use HasFactory;

    protected $fillable = ['nome','especie_id'];

    public function especie() {
        return $this->belongsTo('App\Models\Especie');
    }
}
