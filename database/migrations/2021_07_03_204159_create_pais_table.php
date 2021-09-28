<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pais', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('siglas');
            $table->string('iso');
            $table->integer('rankin')->default(0);
            $table->integer('puntos')->default(0);
            $table->integer('jj')->default(0);
            $table->integer('jg')->default(0);
            $table->integer('je')->default(0);
            $table->integer('jp')->default(0);
            $table->integer('gf')->default(0);
            $table->integer('gc')->default(0);
            $table->float('lat');
            $table->float('lng');
            $table->string('federacion');
            $table->foreignId('confederacion_id')->references('id')->on('confederacions')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('pais');
    }
}
