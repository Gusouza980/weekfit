<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academias', function (Blueprint $table) {
            $table->id();
            
            $table->string("nome", 100)->nullable();
            $table->string("rua", 150)->nullable();
            $table->string("email", 150)->nullable();
            $table->string("telefone", 50)->nullable();
            $table->string("facebook", 255)->nullable();
            $table->string("instagram", 255)->nullable();
            $table->string("youtube", 255)->nullable();
            $table->string("linkedin", 255)->nullable();
            $table->string("pinterest", 255)->nullable();
            $table->string("google_negocio", 255)->nullable();
            $table->string("numero", 10)->nullable();
            $table->string("bairro", 50)->nullable();
            $table->string("cidade", 50)->nullable();
            $table->string("estado", 20)->nullable();
            $table->string("cep", 20)->nullable();
            $table->string("logo", 255)->nullable();
            $table->string("url", 255)->nullable();
            $table->date("inicio_contrato")->nullable();
            $table->date("fim_contrato")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academias');
    }
}
