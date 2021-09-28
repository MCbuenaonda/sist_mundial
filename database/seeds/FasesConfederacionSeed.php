<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasesConfederacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fases_confederacions')->insert(['confederacion_id' => 1, 'fase_id' => 1]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 1, 'fase_id' => 2]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 1, 'fase_id' => 3]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 2, 'fase_id' => 1]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 3, 'fase_id' => 1]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 3, 'fase_id' => 2]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 3, 'fase_id' => 3]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 4, 'fase_id' => 1]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 4, 'fase_id' => 2]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 4, 'fase_id' => 3]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 5, 'fase_id' => 1]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 5, 'fase_id' => 2]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 5, 'fase_id' => 3]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 6, 'fase_id' => 1]);

        DB::table('fases_confederacions')->insert(['confederacion_id' => 6, 'fase_id' => 2]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 6, 'fase_id' => 3]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 6, 'fase_id' => 4]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 7, 'fase_id' => 1]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 8, 'fase_id' => 1]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 8, 'fase_id' => 2]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 8, 'fase_id' => 3]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 8, 'fase_id' => 4]);
        DB::table('fases_confederacions')->insert(['confederacion_id' => 8, 'fase_id' => 5]);

    }
}
  /**
   *
   *13	UEFA
**4.5	CONCACAF
*4.5	CONMEBOL
*5	CAF
*0.5	OFC
*4.5	AFC
*32

   */
