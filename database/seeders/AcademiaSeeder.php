<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'nome' => 'Gefit Academia',
            'rua' => 'Rua Dom Pedro II',
            'email' => 'academia@gmail.com',
            'telefone' => '35988461456',
            'bairro' => 'Vila Formosa',
            'numero' => '74',
            'cidade' => 'Alfenas',
            'estado' => 'MG',
            'cep' => '37131-456',
            'logo' => 'admin/images/logos/gefit.png',
            'inicio_contrato' => '2020-02-25',
            'fim_contrato' => '2020-04-25',
        ]);

        DB::table('usuarios')->insert([
            'nome' => 'Thiago Borges',
            'email' => 'thiago@gmail.com',
            'telefone' => '359884614560',
            'usuario' => 'thiago',
            'senha' => Hash::make('12345'),
            'academia_id' => 1,
            'departamento' => 100,
            'lider' => true,
            'acesso' => 0
        ]);
    }
}
