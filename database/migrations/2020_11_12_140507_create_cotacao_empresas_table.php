<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotacaoEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacao_empresas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cotacao_id'); 
            $table->unsignedBigInteger('pessoa_juridica_id'); 
            $table->foreign('cotacao_id')->references('id')->on('cotacoes');
            $table->foreign('pessoa_juridica_id')->references('id')->on('pessoa_juridicas');
            $table->softDeletes();
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
        Schema::dropIfExists('cotacao_empresas');
    }
}
