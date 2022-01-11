<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardLancamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_lancamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("academia_id");
            $table->date("data");
            $table->double("contrato")->default(0);
            $table->double("mercado")->default(0);
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
        Schema::dropIfExists('dashboard_lancamentos');
    }
}
