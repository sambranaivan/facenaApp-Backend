<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSeguimientoAddEstadoMailUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seguimientos', function (Blueprint $table) {
            //
            $table->string('mail');
            $table->string('estado');//recibido,no recibio,regreso
            $table->boolean('notify')->default(false);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seguimientos', function (Blueprint $table) {
            //
        });
    }
}
