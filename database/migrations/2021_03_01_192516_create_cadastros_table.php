<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadastrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("academia_id");
            $table->string("formulario", 100)->nullable();
            $table->string("nome", 100)->nullable();
            $table->string("email", 150)->nullable();
            $table->string("telefone", 100)->nullable();
            $table->string("celular", 100)->nullable();
            $table->string("cpf", 20)->nullable();
            $table->string("nascimento", 30)->nullable();
            $table->string("rg", 20)->nullable();
            $table->string("sexo", 15)->nullable();
            $table->string("endereco", 255)->nullable();
            $table->string("cep", 20)->nullable();
            $table->string("numero", 10)->nullable();
            $table->string("complemento", 255)->nullable();
            $table->string("cidade", 30)->nullable();
            $table->string("estado", 20)->nullable();
            $table->string("bairro", 30)->nullable();
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
        Schema::dropIfExists('cadastros');
    }
}
