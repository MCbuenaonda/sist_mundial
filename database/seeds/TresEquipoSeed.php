<?php

use Illuminate\Database\Seeder;

class TresEquipoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tres_equipos')->insert([ 'jornada_id' => 1, 'pos1' => 0, 'pos2' => 1, 'pos3' => 2 ]);
        DB::table('tres_equipos')->insert([ 'jornada_id' => 2, 'pos1' => 2, 'pos2' => 0, 'pos3' => 1 ]);
        DB::table('tres_equipos')->insert([ 'jornada_id' => 3, 'pos1' => 1, 'pos2' => 2, 'pos3' => 0 ]);
        DB::table('tres_equipos')->insert([ 'jornada_id' => 4, 'pos1' => 1, 'pos2' => 0, 'pos3' => 2 ]);
        DB::table('tres_equipos')->insert([ 'jornada_id' => 5, 'pos1' => 0, 'pos2' => 2, 'pos3' => 1 ]);
        DB::table('tres_equipos')->insert([ 'jornada_id' => 6, 'pos1' => 2, 'pos2' => 1, 'pos3' => 0 ]);
    }
}
