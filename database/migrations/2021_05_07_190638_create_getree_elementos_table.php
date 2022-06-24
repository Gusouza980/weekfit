<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGetreeElementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('getree_elementos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("academia_id")->nullable();
            $table->string("imagem")->nullable();
            $table->string("titulo")->nullable();
            $table->string("link")->nullable();
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
        Schema::dropIfExists('getree_elementos');
    }
}
