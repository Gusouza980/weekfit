<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usuarios')->insert([
            'nome' => 'Luis Gustavo',
            'email' => 'gusouza980@gmail.com',
            'senha' => Hash::make('12345'),
            'usuario' => 'admin',
            'admin' => true,
            'acesso' => 0
        ]);
    }
}
