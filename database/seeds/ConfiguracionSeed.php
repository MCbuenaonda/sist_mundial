<?php

use Illuminate\Database\Seeder;

class ConfiguracionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuracions')->insert(['rol_id' => 1, 'tiempo_juego' => 60000, 'tiempo_lapso' => 1000, 'tiempo_siguiente' => 3000]);
    }
}
