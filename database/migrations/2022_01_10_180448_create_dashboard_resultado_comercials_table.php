<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardResultadoComercialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_resultado_comercials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("academia_id");
            $table->date("data");
            $table->double("jornada_mentoria_preco")->default(0);
            $table->tinyInteger("jornada_mentoria_quantidade")->default(1);
            $table->double("precificacao_preco")->default(0);
            $table->tinyInteger("precificacao_quantidade")->default(1);
            $table->double("scripts_ligacao_preco")->default(0);
            $table->tinyInteger("scripts_ligacao_quantidade")->default(1);
            $table->double("total")->default(0);
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
        Schema::dropIfExists('dashboard_resultado_comercials');
    }
}
