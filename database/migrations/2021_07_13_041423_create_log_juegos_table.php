<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogJuegosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_juegos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('historia_id')->nullable();
            // $table->foreignId('historia_id')->references('id')->on('historias')->onDelete('cascade');
            $table->integer('minuto');
            $table->string('posesion');
            $table->bigInteger('jugador_id')->nullable();
            // $table->foreignId('jugador_id')->nullable()->references('id')->on('jugadors')->onDelete('cascade');
            $table->tinyInteger('gol');
            $table->bigInteger('accion_id')->nullable();
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
        Schema::dropIfExists('log_juegos');
    }
}
