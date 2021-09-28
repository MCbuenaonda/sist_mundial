<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JornadaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 1' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 2' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 3' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 4' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 5' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 6' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 7' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 8' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 9' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 10' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 11' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 12' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 13' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 14' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 15' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 16' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 17' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 18' ]);
        DB::table('jornadas')->insert([ 'nombre' => 'Jornada 19' ]);
    }
}
