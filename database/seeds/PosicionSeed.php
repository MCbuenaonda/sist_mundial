<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosicionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posicions')->insert(['nombre' => 'Portero', 'siglas' => 'POR', 'sector' => 'Portero']);
        DB::table('posicions')->insert(['nombre' => 'Defensa izquierdo', 'siglas' => 'DFI', 'sector' => 'Defensa']);
        DB::table('posicions')->insert(['nombre' => 'Defensa derecho', 'siglas' => 'DFD', 'sector' => 'Defensa']);
        DB::table('posicions')->insert(['nombre' => 'Lateral izquierdo', 'siglas' => 'LI', 'sector' => 'Defensa']);
        DB::table('posicions')->insert(['nombre' => 'Lateral derecho', 'siglas' => 'LD', 'sector' => 'Defensa']);
        DB::table('posicions')->insert(['nombre' => 'Central izquierdo', 'siglas' => 'MI', 'sector' => 'Medio']);
        DB::table('posicions')->insert(['nombre' => 'Central ofensivo', 'siglas' => 'MC', 'sector' => 'Medio']);
        DB::table('posicions')->insert(['nombre' => 'Central derecho', 'siglas' => 'MD', 'sector' => 'Medio']);
        DB::table('posicions')->insert(['nombre' => 'Extremo izquierdo', 'siglas' => 'EI', 'sector' => 'Delantero']);
        DB::table('posicions')->insert(['nombre' => 'Delantero', 'siglas' => 'DC', 'sector' => 'Delantero']);
        DB::table('posicions')->insert(['nombre' => 'Extremo derecho', 'siglas' => 'ED', 'sector' => 'Delantero']);
    }
}
