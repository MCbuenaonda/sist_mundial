<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dos_equipos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jornada_id')->nullable();
            // $table->foreignId('jornada_id')->references('id')->on('jornadas')->onDelete('cascade');
            $table->integer('pos1');
            $table->integer('pos2');
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
        Schema::dropIfExists('dos_equipos');
    }
}
