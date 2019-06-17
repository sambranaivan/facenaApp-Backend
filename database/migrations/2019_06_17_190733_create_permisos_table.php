<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('usuarios')->default(false);
            $table->boolean('departamentos')->default(false);
            $table->boolean('superadmin')->default(false);
            $table->boolean('alertas')->default(false);
            $table->boolean('rectorado')->default(false);
            $table->boolean('consejo')->default(false);
            $table->boolean('notificaciones')->default(false);
            $table->boolean('buscar_expediente')->default(false);
            $table->boolean('listadoMails')->default(false);
            $table->boolean('mapuche')->default(false);
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
        Schema::dropIfExists('permisos');
    }
}
