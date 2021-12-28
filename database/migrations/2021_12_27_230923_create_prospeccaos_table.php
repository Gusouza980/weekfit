<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspeccaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospeccaos', function (Blueprint $table) {
            $table->id();
            $table->string("nome")->nullable();
            $table->string("cidade", 50)->nullable();
            $table->string("estado", 2)->nullable();
            $table->string("gestor", 100)->nullable();
            $table->string("contato", 100)->nullable();
            $table->string("email", 100)->nullable();
            $table->tinyInteger("status")->default(0);
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
        Schema::dropIfExists('prospeccaos');
    }
}
