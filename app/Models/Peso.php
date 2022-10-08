<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peso extends Model
{
    use HasFactory;

    protected $fillable = ['peso'];

    public function pet() {
        return $this->belongsTo('App\Models\Pet');
    }
}
