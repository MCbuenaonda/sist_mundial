<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasesConfederacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fases_confederacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('confederacion_id')->references('id')->on('confederacions')->onDelete('cascade');
            $table->foreignId('fase_id')->references('id')->on('fases')->onDelete('cascade');
            $table->tinyInteger('activo')->default(0);
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
        Schema::dropIfExists('fases_confederacions');
    }
}
