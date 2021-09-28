<?php

use Illuminate\Database\Seeder;

class OchoEquipoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>1, 'pos1' =>0, 'pos2' =>7, 'pos3' =>1, 'pos4' =>6, 'pos5' =>2, 'pos6' =>5, 'pos7' =>3, 'pos8' =>4]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>2, 'pos1' =>6, 'pos2' =>0, 'pos3' =>7, 'pos4' =>5, 'pos5' =>1, 'pos6' =>4, 'pos7' =>2, 'pos8' =>3]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>3, 'pos1' =>0, 'pos2' =>5, 'pos3' =>6, 'pos4' =>4, 'pos5' =>7, 'pos6' =>3, 'pos7' =>1, 'pos8' =>2]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>4, 'pos1' =>4, 'pos2' =>0, 'pos3' =>5, 'pos4' =>3, 'pos5' =>6, 'pos6' =>2, 'pos7' =>7, 'pos8' =>1]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>5, 'pos1' =>0, 'pos2' =>3, 'pos3' =>4, 'pos4' =>2, 'pos5' =>5, 'pos6' =>1, 'pos7' =>6, 'pos8' =>7]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>6, 'pos1' =>2, 'pos2' =>0, 'pos3' =>3, 'pos4' =>1, 'pos5' =>4, 'pos6' =>7, 'pos7' =>5, 'pos8' =>6]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>7, 'pos1' =>0, 'pos2' =>1, 'pos3' =>2, 'pos4' =>7, 'pos5' =>3, 'pos6' =>6, 'pos7' =>4, 'pos8' =>5]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>8, 'pos1' =>7, 'pos2' =>0, 'pos3' =>6, 'pos4' =>1, 'pos5' =>5, 'pos6' =>2, 'pos7' =>4, 'pos8' =>3]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>9, 'pos1' =>0, 'pos2' =>6, 'pos3' =>5, 'pos4' =>7, 'pos5' =>4, 'pos6' =>1, 'pos7' =>3, 'pos8' =>2]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>10, 'pos1' =>5, 'pos2' =>0, 'pos3' =>4, 'pos4' =>6, 'pos5' =>3, 'pos6' =>7, 'pos7' =>2, 'pos8' =>1]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>12, 'pos1' =>3, 'pos2' =>0, 'pos3' =>2, 'pos4' =>4, 'pos5' =>1, 'pos6' =>5, 'pos7' =>7, 'pos8' =>6]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>11, 'pos1' =>0, 'pos2' =>4, 'pos3' =>3, 'pos4' =>5, 'pos5' =>2, 'pos6' =>6, 'pos7' =>1, 'pos8' =>7]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>13, 'pos1' =>0, 'pos2' =>2, 'pos3' =>1, 'pos4' =>3, 'pos5' =>7, 'pos6' =>4, 'pos7' =>6, 'pos8' =>5]);
        DB::table('ocho_equipos')->insert([ 'jornada_id' =>14, 'pos1' =>1, 'pos2' =>0, 'pos3' =>7, 'pos4' =>2, 'pos5' =>6, 'pos6' =>3, 'pos7' =>5, 'pos8' =>4]);

    }
}
