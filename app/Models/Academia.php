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

    public function jornadas(){
        return $this->hasMany(JornadaCheck::class);
    }

    public function proprietario(){
        return $this->usuarios()->where("departamento", 100);
    }

    public function getree(){
        return $this->hasMany(GetreeElemento::class);
    }

    public function acessos(){
        return $this->hasMany(GetreeAcesso::class);
    }

    public function leads(){
        return $this->hasMany(Lead::class);
    }
    
}
