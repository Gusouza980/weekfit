<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJornadaChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jornada_checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("academia_id");
            $table->unsignedBigInteger("atividade_id");
            $table->boolean("completo")->default(false);
            $table->date("data_completo")->nullable();
            $table->timestamps();
            $table->foreign('academia_id')->references('id')->on('academias')->onDelete('cascade');
            $table->foreign('atividade_id')->references('id')->on('jornada_atividades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jornada_checks');
    }
}
