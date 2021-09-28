<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcacafsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concacafs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pais_id')->references('id')->on('pais')->onDelete('cascade');
            $table->foreignId('fase_confederacion_id')->nullable()->references('id')->on('fases_confederacions')->onDelete('cascade');
            $table->foreignId('grupo_id')->nullable()->references('id')->on('grupos')->onDelete('cascade');
            $table->integer('posicion')->nullable();
            $table->integer('puntos')->default(0);
            $table->integer('jj')->default(0);
            $table->integer('jg')->default(0);
            $table->integer('je')->default(0);
            $table->integer('jp')->default(0);
            $table->integer('gf')->default(0);
            $table->integer('gc')->default(0);
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
        Schema::dropIfExists('concacafs');
    }
}
