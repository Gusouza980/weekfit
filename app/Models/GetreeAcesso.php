<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetreeAcesso extends Model
{
    use HasFactory;

    public function clicks(){
        return $this->hasMany(GetreeClick::class);
    }

    public function visitante(){
        return $this->belongsTo(GetreeVisitante::class);
    }
}
