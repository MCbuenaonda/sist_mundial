<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('posicion_id')->references('id')->on('posicions')->onDelete('cascade');
            $table->foreignId('pais_id')->references('id')->on('pais')->onDelete('cascade');
            $table->integer('goles');
            $table->integer('goles_temp');
            $table->integer('botin');
            $table->tinyInteger('estrella');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jugadors');
    }
}
