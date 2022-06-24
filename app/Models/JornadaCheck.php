<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JornadaCheck extends Model
{
    use HasFactory;

    public function atividade(){
        return $this->belongsTo(JornadaAtividade::class, "atividade_id", "id");
    }
}
