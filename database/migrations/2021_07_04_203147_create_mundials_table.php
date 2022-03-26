<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMundialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mundials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pais_id')->nullable();
            // $table->foreignId('pais_id')->references('id')->on('pais')->onDelete('cascade');
            $table->integer('anio');
            $table->integer('campeon')->default(0);
            $table->tinyInteger('activo')->default(1);
            $table->integer('botin')->default(0);
            $table->integer('por')->default(0);
            $table->integer('dfi')->default(0);
            $table->integer('dfd')->default(0);
            $table->integer('li')->default(0);
            $table->integer('ld')->default(0);
            $table->integer('mi')->default(0);
            $table->integer('mc')->default(0);
            $table->integer('md')->default(0);
            $table->integer('ei')->default(0);
            $table->integer('dc')->default(0);
            $table->integer('ed')->default(0);
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
        Schema::dropIfExists('mundials');
    }
}
