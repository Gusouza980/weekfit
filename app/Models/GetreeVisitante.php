<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetreeVisitante extends Model
{
    use HasFactory;

    public function acessos(){
        return $this->hasMany(GetreeAcesso::class);
    }

    public function clicks(){
        return $this->hasMany(GetreeClick::class);
    }
}
