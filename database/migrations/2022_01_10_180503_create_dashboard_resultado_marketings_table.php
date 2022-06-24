<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardResultadoMarketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_resultado_marketings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("academia_id");
            $table->date("data");
            $table->double("jornada_mentoria_preco")->default(0);
            $table->tinyInteger("jornada_mentoria_quantidade")->default(1);
            $table->double("editorial_preco")->default(0);
            $table->tinyInteger("editorial_quantidade")->default(1);
            $table->double("post_imagem_padrao_preco")->default(0);
            $table->tinyInteger("post_imagem_padrao_quantidade")->default(1);
            $table->double("post_video_padrao_preco")->default(0);
            $table->tinyInteger("post_video_padrao_quantidade")->default(1);
            $table->double("post_metodologia_preco")->default(0);
            $table->tinyInteger("post_metodologia_quantidade")->default(1);
            $table->double("post_imagem_personalizado_preco")->default(0);
            $table->tinyInteger("post_imagem_personalizado_quantidade")->default(1);
            $table->double("post_video_personalizado_preco")->default(0);
            $table->tinyInteger("post_video_personalizado_quantidade")->default(1);
            $table->double("artigo_tecnico_preco")->default(0);
            $table->tinyInteger("artigo_tecnico_quantidade")->default(1);
            $table->double("agendamento_publicacoes_monitoramento_preco")->default(0);
            $table->tinyInteger("agendamento_publicacoes_monitoramento_quantidade")->default(1);
            $table->double("campanha_online_preco")->default(0);
            $table->tinyInteger("campanha_online_quantidade")->default(1);
            $table->double("campanha_offline_preco")->default(0);
            $table->tinyInteger("campanha_offline_quantidade")->default(1);
            $table->double("proposta_ativacao_parceria_preco")->default(0);
            $table->tinyInteger("proposta_ativacao_parceria_quantidade")->default(1);
            $table->double("getree_preco")->default(0);
            $table->tinyInteger("getree_quantidade")->default(1);
            $table->double("site_institucional_preco")->default(0);
            $table->tinyInteger("site_institucional_quantidade")->default(1);
            $table->double("pagina_captura_preco")->default(0);
            $table->tinyInteger("pagina_captura_quantidade")->default(1);
            $table->double("email_personalizado_preco")->default(0);
            $table->tinyInteger("email_personalizado_quantidade")->default(1);
            $table->double("guias_manuais_preco")->default(0);
            $table->tinyInteger("guias_manuais_quantidade")->default(1);
            $table->double("total")->default(0);
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
        Schema::dropIfExists('dashboard_resultado_marketings');
    }
}
