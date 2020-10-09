<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pessoa_id'); 
            $table->string('address');
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('postal_code');
            $table->string('neighborhood'); // bairro
            $table->string('city');
            $table->string('state');
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
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
        Schema::dropIfExists('addresses');
    }
}
