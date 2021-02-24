<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadeAcademiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade_academias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("academia_id");
            $table->unsignedBigInteger("atividade_id");
            $table->unsignedBigInteger("subgrupo_id");
            $table->string("observacao")->nullable();
            /*
                0 => Em Aberto
                1 => Em Andamento
                2 => Concluído
            */
            $table->smallInteger("status")->default(0);
            $table->boolean("ativo")->default(true);
            $table->timestamps();
            $table->foreign('academia_id')->references('id')->on('academias')->onDelete('cascade');
            $table->foreign('atividade_id')->references('id')->on('atividades')->onDelete('cascade');
            $table->foreign('subgrupo_id')->references('id')->on('subgrupos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividade_academias');
    }
}
