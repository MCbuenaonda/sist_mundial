<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigInteger('pais_id')->nullable();
            $table->bigInteger('confederacion_id')->nullable();
            $table->longText('bandera')->nullable();
            $table->longText('jersey')->nullable();
            $table->longText('icono')->nullable();
            $table->longText('escudo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
