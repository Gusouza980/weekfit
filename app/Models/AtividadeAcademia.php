<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtividadeAcademia extends Model
{
    use HasFactory;

    public function atividade(){
        return $this->belongsTo(Atividade::class, "atividade_id", "id");
    }
}
