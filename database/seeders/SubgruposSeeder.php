<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SubgruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $grupos = \App\Models\Grupo::all();

        foreach($grupos as $grupo){
            for($i = 0; $i < 5; $i++){
                DB::table('subgrupos')->insert([
                    'grupo_id' => $grupo->id,
                    'nome' => 'Subgrupo ' . $i
                ]);
            }
        }
    }
}
