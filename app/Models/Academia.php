<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academia extends Model
{
    use HasFactory;

    public function usuarios(){
        return $this->hasMany(Usuario::class);
    }

    public function atividades(){
        return $this->hasMany(AtividadeAcademia::class, "academia_id", "id");
    }

    public function proprietario(){
        return $this->usuarios()->where("departamento", 100);
    }
}
