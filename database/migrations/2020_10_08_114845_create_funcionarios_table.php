<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pessoa_fisica_id'); 
            $table->string('matricula');
            $table->string('type_contract'); // clt, commisionado
            $table->string('role');
            $table->string('sector');
            $table->string('portaria');
            $table->foreign('pessoa_fisica_id')->references('id')->on('pessoa_fisicas');
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
        Schema::dropIfExists('funcionarios');
    }
}
