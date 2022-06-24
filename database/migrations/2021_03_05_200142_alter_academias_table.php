<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAcademiasTable extends Migration
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
            $table->dropColumn("login_painel");
            $table->dropColumn("senha_painel");
            $table->string("painel")->nullable();
            $table->string("tiktok", 255)->nullable();
            $table->string("login_tiktok", 255)->nullable();
            $table->string("senha_tiktok", 255)->nullable();
            $table->boolean("ativo")->default(true);
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
