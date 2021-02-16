<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AcademiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('academias')->insert([
            'nome' => 'Appolo Fitness',
            'rua' => 'Rua teste',
            'bairro' => 'Bairro Teste',
            'numero' => '123',
            'cidade' => 'Alfenas',
            'estado' => 'MG',
            'cep' => '37131-000'
        ]);
    }
}
