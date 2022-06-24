<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academia_id')->nullable();
            $table->string("nome", 100);
            $table->string("foto")->nullable();
            $table->string("email", 150)->unique();
            $table->string("telefone", 50)->nullable();
            $table->string("usuario", 100)->unique();
            $table->string("senha", 255);
            /*

                100 => Proprietário
                0 => Administrativo
                1 => Técnico
                2 => Comercial
                3 => Marketing

            */
            $table->smallInteger("departamento")->nullable();
            $table->boolean("lider")->default(false);
            $table->boolean("admin")->default(false);
            $table->smallInteger("acesso");
            $table->timestamps();
            $table->foreign('academia_id')->references('id')->on('academias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
