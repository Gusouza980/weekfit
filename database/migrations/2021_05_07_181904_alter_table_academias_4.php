<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAcademias4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('academias', function (Blueprint $table) {
            $table->string("slug_getree", 20)->nullable();
            $table->string("titulo_getree", 100)->nullable();
            $table->string("cor_titulo_getree", 7)->nullable();
            $table->string("subtitulo_getree", 255)->nullable();
            $table->string("cor_subtitulo_getree", 7)->nullable();
            $table->string("fundo_getree", 255)->nullable();
            $table->string("cor_fundo_cartao_getree", 7)->nullable();
            $table->string("cor_fundo_cartao_hover_getree", 7)->nullable();
            $table->string("cor_letra_cartao_getree", 7)->nullable();
            $table->string("cor_letra_cartao_hover_getree", 7)->nullable();
            $table->boolean("facebook_getree")->default(false);
            $table->boolean("linkedin_getree")->default(false);
            $table->boolean("instagram_getree")->default(false);
            $table->boolean("pinterest_getree")->default(false);
            $table->boolean("twitter_getree")->default(false);
            $table->boolean("youtube_getree")->default(false);
            $table->boolean("google_negocio_getree")->default(false);
            $table->boolean("tiktok_getree")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
