<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGetreeAcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('getree_acessos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("getree_visitante_id");
            $table->unsignedBigInteger("academia_id");
            $table->foreign('getree_visitante_id')->references('id')->on('getree_visitantes')->onDelete('cascade');
            $table->foreign('academia_id')->references('id')->on('academias')->onDelete('cascade');
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
        Schema::dropIfExists('getree_acessos');
    }
}
