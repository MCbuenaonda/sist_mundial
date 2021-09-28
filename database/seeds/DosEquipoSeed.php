<?php

use Illuminate\Database\Seeder;

class DosEquipoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dos_equipos')->insert([ 'jornada_id' => 1, 'pos1' => 0, 'pos2' => 1 ]);
        DB::table('dos_equipos')->insert([ 'jornada_id' => 2, 'pos1' => 1, 'pos2' => 0 ]);
    }
}
