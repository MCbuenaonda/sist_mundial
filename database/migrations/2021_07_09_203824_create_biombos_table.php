<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biombos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pais_id')->references('id')->on('pais')->onDelete('cascade');
            $table->foreignId('confederacion_id')->nullable()->references('id')->on('confederacions')->onDelete('cascade');
            $table->integer('rankin');
            $table->integer('biombo')->nullable();
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
        Schema::dropIfExists('biombos');
    }
}
