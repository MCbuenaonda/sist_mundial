<?php

use Illuminate\Database\Seeder;

class SeisEquipoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seis_equipos')->insert([ 'jornada_id' =>1, 'pos1' =>0, 'pos2' =>1, 'pos3' =>2, 'pos4' =>4, 'pos5' =>3, 'pos6' =>5]);
        DB::table('seis_equipos')->insert([ 'jornada_id' =>2, 'pos1' =>1, 'pos2' =>5, 'pos3' =>0, 'pos4' =>2, 'pos5' =>4, 'pos6' =>3]);
        DB::table('seis_equipos')->insert([ 'jornada_id' =>3, 'pos1' =>5, 'pos2' =>4, 'pos3' =>2, 'pos4' =>1, 'pos5' =>3, 'pos6' =>0]);
        DB::table('seis_equipos')->insert([ 'jornada_id' =>4, 'pos1' =>1, 'pos2' =>3, 'pos3' =>0, 'pos4' =>4, 'pos5' =>5, 'pos6' =>2]);
        DB::table('seis_equipos')->insert([ 'jornada_id' =>5, 'pos1' =>4, 'pos2' =>1, 'pos3' =>5, 'pos4' =>0, 'pos5' =>2, 'pos6' =>3]);
        DB::table('seis_equipos')->insert([ 'jornada_id' =>6, 'pos1' =>1, 'pos2' =>0, 'pos3' =>4, 'pos4' =>2, 'pos5' =>5, 'pos6' =>3]);
        DB::table('seis_equipos')->insert([ 'jornada_id' =>7, 'pos1' =>5, 'pos2' =>1, 'pos3' =>2, 'pos4' =>0, 'pos5' =>3, 'pos6' =>4]);
        DB::table('seis_equipos')->insert([ 'jornada_id' =>8, 'pos1' =>4, 'pos2' =>5, 'pos3' =>1, 'pos4' =>2, 'pos5' =>0, 'pos6' =>3]);
        DB::table('seis_equipos')->insert([ 'jornada_id' =>9, 'pos1' =>3, 'pos2' =>1, 'pos3' =>4, 'pos4' =>0, 'pos5' =>2, 'pos6' =>5]);
        DB::table('seis_equipos')->insert([ 'jornada_id' =>10, 'pos1' =>1, 'pos2' =>4, 'pos3' =>0, 'pos4' =>5, 'pos5' =>3, 'pos6' =>2]);

    }
}
