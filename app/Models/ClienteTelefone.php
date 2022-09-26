<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteTelefone extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'numero', 'cliente_id'];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente');
    }
}
