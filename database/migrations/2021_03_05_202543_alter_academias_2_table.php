<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAcademias2Table extends Migration
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
            $table->double("total_geral")->default(0);
            $table->double("total_administrativo")->default(0);
            $table->double("total_tecnico")->default(0);
            $table->double("total_marketing")->default(0);
            $table->double("total_comercial")->default(0);
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
