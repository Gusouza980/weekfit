<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospeccao extends Model
{
    use HasFactory;

    public function notas(){
        return $this->hasMany(ProspeccaoNota::class);
    }
}
