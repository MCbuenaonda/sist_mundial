<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogApuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_apuestas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('historia_id')->nullable();
            $table->bigInteger('pais_id')->nullable();
            $table->bigInteger('cuenta_id')->nullable();
            $table->integer('monto')->nullable();
            $table->integer('activo')->nullable();
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
        Schema::dropIfExists('log_apuestas');
    }
}
