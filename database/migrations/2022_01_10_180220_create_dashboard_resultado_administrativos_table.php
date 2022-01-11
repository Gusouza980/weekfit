<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardResultadoAdministrativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_resultado_administrativos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("academia_id");
            $table->date("data");
            $table->double("jornada_mentoria_preco")->default(0);
            $table->tinyInteger("jornada_mentoria_quantidade")->default(1);
            $table->double("checklist_preco")->default(0);
            $table->tinyInteger("checklist_quantidade")->default(1);
            $table->double("juros")->default(0);
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
        Schema::dropIfExists('dashboard_resultado_administrativos');
    }
}
