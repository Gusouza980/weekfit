<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetreeClick extends Model
{
    use HasFactory;

    public function element(){
        return $this->belongsTo(GetreeElemento::class, "getree_elemento_id", "id");
    }
}
