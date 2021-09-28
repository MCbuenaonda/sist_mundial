<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grupos')->insert([ 'nombre' => 'A' ]);
        DB::table('grupos')->insert([ 'nombre' => 'B' ]);
        DB::table('grupos')->insert([ 'nombre' => 'C' ]);
        DB::table('grupos')->insert([ 'nombre' => 'D' ]);
        DB::table('grupos')->insert([ 'nombre' => 'E' ]);
        DB::table('grupos')->insert([ 'nombre' => 'F' ]);
        DB::table('grupos')->insert([ 'nombre' => 'G' ]);
        DB::table('grupos')->insert([ 'nombre' => 'H' ]);
        DB::table('grupos')->insert([ 'nombre' => 'I' ]);
        DB::table('grupos')->insert([ 'nombre' => 'J' ]);
        DB::table('grupos')->insert([ 'nombre' => 'K' ]);
        DB::table('grupos')->insert([ 'nombre' => 'L' ]);
        DB::table('grupos')->insert([ 'nombre' => 'M' ]);
        DB::table('grupos')->insert([ 'nombre' => 'N' ]);
        DB::table('grupos')->insert([ 'nombre' => 'O' ]);
        DB::table('grupos')->insert([ 'nombre' => 'P' ]);
        DB::table('grupos')->insert([ 'nombre' => 'Q' ]);
        DB::table('grupos')->insert([ 'nombre' => 'R' ]);
        DB::table('grupos')->insert([ 'nombre' => 'S' ]);
        DB::table('grupos')->insert([ 'nombre' => 'T' ]);
        DB::table('grupos')->insert([ 'nombre' => 'U' ]);
        DB::table('grupos')->insert([ 'nombre' => 'V' ]);
        DB::table('grupos')->insert([ 'nombre' => 'W' ]);
        DB::table('grupos')->insert([ 'nombre' => 'X' ]);
        DB::table('grupos')->insert([ 'nombre' => 'Y' ]);
        DB::table('grupos')->insert([ 'nombre' => 'Z' ]);
    }
}
