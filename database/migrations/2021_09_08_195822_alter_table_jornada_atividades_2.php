<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableJornadaAtividades2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('jornada_atividades', function (Blueprint $table) {
            /*
                0 => "Administrativo",
                1 => "Técnico",
                2 => "Comercial",
                3 => "Marketing",
            */
            $table->tinyInteger("departamento")->default(0);

            /*
                0 => Tiago
                1 => Carol
                2 => Nelson
            */
            $table->tinyInteger("responsavel")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
