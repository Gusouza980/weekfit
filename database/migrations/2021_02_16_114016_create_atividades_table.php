<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subgrupo_id");
            $table->string("nome");
            $table->string("link")->nullable();
            $table->string("texto_link")->nullable();
            /*
                0 => Básico
                1 => Importante
            */
            $table->smallInteger("importancia");
            $table->timestamps();
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
        Schema::dropIfExists('atividades');
    }
}
