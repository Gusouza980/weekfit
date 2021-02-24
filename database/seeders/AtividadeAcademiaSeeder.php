<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AtividadeAcademiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $atividades = \App\Models\Atividade::all();

        foreach($atividades as $atividade){
            DB::table('atividade_academias')->insert([
                'academia_id' => 1,
                'atividade_id' => $atividade->id,
                'subgrupo_id' => $atividade->subgrupo_id
            ]);
        }
    }
}
