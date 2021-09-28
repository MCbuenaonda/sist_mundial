<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mundial_id')->references('id')->on('mundials')->onDelete('cascade');
            $table->foreignId('confederacion_id')->references('id')->on('confederacions')->onDelete('cascade');
            $table->foreignId('fase_id')->references('id')->on('fases')->onDelete('cascade');
            $table->foreignId('jornada_id')->references('id')->on('jornadas')->onDelete('cascade');
            $table->foreignId('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
            $table->foreignId('pais_id_l')->references('id')->on('pais')->onDelete('cascade');
            $table->foreignId('pais_id_v')->references('id')->on('pais')->onDelete('cascade');
            $table->integer('gol_l')->default(0);
            $table->integer('gol_v')->default(0);
            $table->tinyInteger('activo')->default(0);
            $table->foreignId('ciudad_id')->references('id')->on('ciudads')->onDelete('cascade');
            $table->date('fecha');
            $table->string('tag');
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
        Schema::dropIfExists('historias');
    }
}
