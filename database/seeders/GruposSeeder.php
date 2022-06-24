<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $grupos[0] = ["Gestão", "Financeiro", "Contábil", "Recurso Humano", "Jurídico", "Operacional", "Estratégico", "KPI"];
        $grupos[1] = ["Treino", "Avaliação", "Programa", "Sucesso do Cliente", "KPI"];
        $grupos[2] = ["Recepção", "Técnico", "Online", "Planos", "Programas", "Produtos", "KPI"];
        $grupos[3] = ["Site", "Rede Social", "Sistemas", "Online", "Presencial", "Enxoval", "KPI"];

        foreach($grupos[0] as $grupo){
            DB::table('grupos')->insert([
                'departamento' => 0,
                'nome' => $grupo
            ]);
        }

        foreach($grupos[1] as $grupo){
            DB::table('grupos')->insert([
                'departamento' => 1,
                'nome' => $grupo
            ]);
        }

        foreach($grupos[2] as $grupo){
            DB::table('grupos')->insert([
                'departamento' => 2,
                'nome' => $grupo
            ]);
        }

        foreach($grupos[3] as $grupo){
            DB::table('grupos')->insert([
                'departamento' => 3,
                'nome' => $grupo
            ]);
        }

        
        
    }
}
