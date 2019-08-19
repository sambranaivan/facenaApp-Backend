<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomMailsBehavior extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mails', function (Blueprint $table) {
            //
            $table->date('desde')->nullable();//desde el
            $table->date('hasta')->nullable();//hasta el
            $table->integer('cada')->nullable();//cada N dias a las H horas
            $table->boolean('state')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mails', function (Blueprint $table) {
            //
        });
    }
}
