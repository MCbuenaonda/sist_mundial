<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->bigInteger('confederacion_id')->nullable();
            $table->bigInteger('fase_id')->nullable();
            $table->bigInteger('jornada_id')->nullable();
            // $table->foreignId('confederacion_id')->references('id')->on('confederacions')->onDelete('cascade');
            // $table->foreignId('fase_id')->references('id')->on('fases')->onDelete('cascade');
            // $table->foreignId('jornada_id')->references('id')->on('jornadas')->onDelete('cascade');
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
        Schema::dropIfExists('fechas');
    }
}
