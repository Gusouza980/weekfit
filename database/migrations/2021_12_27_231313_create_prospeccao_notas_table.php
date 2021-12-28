<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspeccaoNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospeccao_notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("prospeccao_id");
            $table->string("texto");
            $table->timestamps();
            $table->foreign('prospeccao_id')->references('id')->on('prospeccaos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospeccao_notas');
    }
}
