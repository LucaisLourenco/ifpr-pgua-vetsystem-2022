<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTelefone extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'numero', 'user_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
