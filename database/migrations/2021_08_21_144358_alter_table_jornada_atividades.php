<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableJornadaAtividades extends Migration
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
            $table->string("link")->nullable();
            $table->string("texto_link")->nullable();
            /*
                0 => Básico
                1 => Importante
            */
            $table->smallInteger("importancia");
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
