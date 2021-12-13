<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGetreeVisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('getree_visitantes', function (Blueprint $table) {
            $table->id();
            $table->string("ip", 16)->nullable();
            $table->string("ip_uf", 2)->nullable();
            $table->string("ip_cidade", 50)->nullable();
            $table->string("ip_cep", 10)->nullable();
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
        Schema::dropIfExists('getree_visitantes');
    }
}
