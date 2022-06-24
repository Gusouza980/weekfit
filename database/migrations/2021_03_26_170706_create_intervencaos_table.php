<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervencaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervencaos', function (Blueprint $table) {
            $table->id();
            $table->string("situacao", 2)->default(1);
            $table->unsignedBigInteger("academia_id")->nullable();
            $table->string("identificador");
            $table->string("assunto")->nullable();
            $table->text("observacao")->nullable();
            $table->string("usuario")->nullable();
            $table->dateTime("inicio")->nullable();
            $table->dateTime("fim")->nullable();
            $table->timestamps();
            $table->foreign('academia_id')->references('id')->on('academias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intervencaos');
    }
}
