<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AtividadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $grupos = \App\Models\Grupo::where("departamento", "0")->get();
        $num_grupos = $grupos->count();

        $cont = 1;
        foreach($grupos as $grupo){
            foreach($grupo->subgrupos as $subgrupo){
                $total = random_int(1,4);
                for($i = 0; $i < $total; $i++){
                    DB::table('atividades')->insert([
                        'subgrupo_id' => $subgrupo->id,
                        'nome' => 'Atividade ' . $cont,
                        'importancia' => random_int(0,1)
                    ]);
                    $cont++;
                }
            }
        }

        $grupos = \App\Models\Grupo::where("departamento", "1")->get();
        $num_grupos = $grupos->count();

        $cont = 1;
        foreach($grupos as $grupo){
            foreach($grupo->subgrupos as $subgrupo){
                $total = random_int(1,4);
                for($i = 0; $i < 2; $i++){
                    DB::table('atividades')->insert([
                        'subgrupo_id' => $subgrupo->id,
                        'nome' => 'Atividade ' . $cont,
                        'importancia' => random_int(0,1)
                    ]);
                    $cont++;
                }
            }
        }

        $grupos = \App\Models\Grupo::where("departamento", "2")->get();
        $num_grupos = $grupos->count();

        $cont = 1;
        foreach($grupos as $grupo){
            foreach($grupo->subgrupos as $subgrupo){
                $total = random_int(1,4);
                for($i = 0; $i < 2; $i++){
                    DB::table('atividades')->insert([
                        'subgrupo_id' => $subgrupo->id,
                        'nome' => 'Atividade ' . $cont,
                        'importancia' => random_int(0,1)
                    ]);
                    $cont++;
                }
            }
        }

        $grupos = \App\Models\Grupo::where("departamento", "3")->get();
        $num_grupos = $grupos->count();

        $cont = 1;
        foreach($grupos as $grupo){
            foreach($grupo->subgrupos as $subgrupo){
                $total = random_int(1,4);
                for($i = 0; $i < 2; $i++){
                    DB::table('atividades')->insert([
                        'subgrupo_id' => $subgrupo->id,
                        'nome' => 'Atividade ' . $cont,
                        'importancia' => random_int(0,1)
                    ]);
                    $cont++;
                }
            }
        }
        
    }
}
