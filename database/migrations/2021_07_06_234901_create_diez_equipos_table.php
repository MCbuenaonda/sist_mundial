<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiezEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diez_equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jornada_id')->references('id')->on('jornadas')->onDelete('cascade');
            $table->integer('pos1');
            $table->integer('pos2');
            $table->integer('pos3');
            $table->integer('pos4');
            $table->integer('pos5');
            $table->integer('pos6');
            $table->integer('pos7');
            $table->integer('pos8');
            $table->integer('pos9');
            $table->integer('pos10');
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
        Schema::dropIfExists('diez_equipos');
    }
}
