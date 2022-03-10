<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOchoEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocho_equipos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jornada_id')->nullable();
            // $table->foreignId('jornada_id')->references('id')->on('jornadas')->onDelete('cascade');
            $table->integer('pos1');
            $table->integer('pos2');
            $table->integer('pos3');
            $table->integer('pos4');
            $table->integer('pos5');
            $table->integer('pos6');
            $table->integer('pos7');
            $table->integer('pos8');
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
        Schema::dropIfExists('ocho_equipos');
    }
}
