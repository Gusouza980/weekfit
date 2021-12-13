<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGetreeClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('getree_clicks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("getree_visitante_id");
            $table->unsignedBigInteger("getree_acesso_id");
            $table->unsignedBigInteger("getree_elemento_id")->nullable();
            $table->boolean("elemento")->default(true);
            $table->boolean("rede")->default(false);
            /*
                0 => Site
                1 => Whatsapp
                2 => Facebook
                3 => Linkedin
                4 => Instagram
                5 => Pinterest
                6 => Twitter
                7 => Youtube
                8 => Tiktok
                9 => Email
            */
            $table->boolean("tipo_rede")->nullable();
            $table->foreign('getree_visitante_id')->references('id')->on('getree_visitantes')->onDelete('cascade');
            $table->foreign('getree_acesso_id')->references('id')->on('getree_acessos')->onDelete('cascade');
            $table->foreign('getree_elemento_id')->references('id')->on('getree_elementos')->onDelete('cascade');
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
        Schema::dropIfExists('getree_clicks');
    }
}
