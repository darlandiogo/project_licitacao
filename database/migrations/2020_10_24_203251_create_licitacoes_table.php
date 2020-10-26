<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicitacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licitacoes', function (Blueprint $table) {
            $table->id();
            $table->string('process_number');
            $table->date('process_date');
            $table->string('bidding_number');
            $table->unsignedBigInteger('licitacao_modality_id');
            $table->unsignedBigInteger('licitacao_type_id');
            $table->unsignedBigInteger('licitacao_form_id');
            $table->unsignedBigInteger('licitacao_regime_id');
            $table->string('bidding_objective');
            $table->string('justification');
            $table->string('purpose_contract');
            $table->string('way_execution');
            $table->string('validity_contract');
            $table->string('deadline_contract');
            $table->string('general_considerations');
            $table->string('bidding_organ');
            $table->string('emiter_name');
            $table->string('emiter_office');
            $table->string('disbursement_schedule');
            $table->date('edital_date');
            $table->dateTime('datetime_open');
            $table->string('status_process');
            $table->string('sector_id'); // secretaria_id : []
            $table->decimal('value', 13, 2);
            $table->foreign('licitacao_modality_id')->references('id')->on('licitacao_modalities');
            $table->foreign('licitacao_type_id')->references('id')->on('licitacao_types');
            $table->foreign('licitacao_form_id')->references('id')->on('licitacao_forms');
            $table->foreign('licitacao_regime_id')->references('id')->on('licitacao_regimes');
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
        Schema::dropIfExists('licitacoes');
    }
}
