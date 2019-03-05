<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlarmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alarmas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('departamento');
            $table->string('email');
            $table->string('escalar');
            $table->integer('amarillo');
            $table->integer('rojo');
            $table->integer('tipo');//tipo en espera o en departamento
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
        Schema::dropIfExists('alarmas');
    }
}
