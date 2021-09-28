<?php

use Illuminate\Database\Seeder;

class DiezEquipoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diez_equipos')->insert([ 'jornada_id' =>1, 'pos1' =>0, 'pos2' =>7, 'pos3' =>1, 'pos4' =>2, 'pos5' =>3, 'pos6' =>6, 'pos7' =>4, 'pos8' =>5, 'pos9' =>9, 'pos10' =>8]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>2, 'pos1' =>2, 'pos2' =>0, 'pos3' =>5, 'pos4' =>9, 'pos5' =>6, 'pos6' =>4, 'pos7' =>7, 'pos8' =>3, 'pos9' =>8, 'pos10' =>1]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>3, 'pos1' =>0, 'pos2' =>8, 'pos3' =>1, 'pos4' =>5, 'pos5' =>3, 'pos6' =>2, 'pos7' =>7, 'pos8' =>6, 'pos9' =>9, 'pos10' =>4]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>4, 'pos1' =>2, 'pos2' =>7, 'pos3' =>4, 'pos4' =>1, 'pos5' =>5, 'pos6' =>0, 'pos7' =>6, 'pos8' =>9, 'pos9' =>8, 'pos10' =>3]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>5, 'pos1' =>0, 'pos2' =>4, 'pos3' =>1, 'pos4' =>9, 'pos5' =>2, 'pos6' =>6, 'pos7' =>3, 'pos8' =>5, 'pos9' =>7, 'pos10' =>8]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>6, 'pos1' =>4, 'pos2' =>3, 'pos3' =>5, 'pos4' =>7, 'pos5' =>6, 'pos6' =>1, 'pos7' =>8, 'pos8' =>2, 'pos9' =>9, 'pos10' =>0]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>7, 'pos1' =>0, 'pos2' =>1, 'pos3' =>2, 'pos4' =>5, 'pos5' =>3, 'pos6' =>9, 'pos7' =>7, 'pos8' =>4, 'pos9' =>8, 'pos10' =>6]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>8, 'pos1' =>0, 'pos2' =>6, 'pos3' =>1, 'pos4' =>3, 'pos5' =>4, 'pos6' =>2, 'pos7' =>5, 'pos8' =>8, 'pos9' =>9, 'pos10' =>7]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>9, 'pos1' =>2, 'pos2' =>9, 'pos3' =>3, 'pos4' =>0, 'pos5' =>6, 'pos6' =>5, 'pos7' =>7, 'pos8' =>1, 'pos9' =>8, 'pos10' =>4]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>10, 'pos1' =>7, 'pos2' =>0, 'pos3' =>2, 'pos4' =>1, 'pos5' =>6, 'pos6' =>3, 'pos7' =>5, 'pos8' =>4, 'pos9' =>8, 'pos10' =>9]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>11, 'pos1' =>0, 'pos2' =>2, 'pos3' =>9, 'pos4' =>5, 'pos5' =>4, 'pos6' =>6, 'pos7' =>3, 'pos8' =>7, 'pos9' =>1, 'pos10' =>8]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>12, 'pos1' =>0, 'pos2' =>8, 'pos3' =>5, 'pos4' =>1, 'pos5' =>2, 'pos6' =>3, 'pos7' =>6, 'pos8' =>7, 'pos9' =>4, 'pos10' =>9]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>13, 'pos1' =>7, 'pos2' =>2, 'pos3' =>1, 'pos4' =>4, 'pos5' =>0, 'pos6' =>5, 'pos7' =>9, 'pos8' =>6, 'pos9' =>3, 'pos10' =>8]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>14, 'pos1' =>4, 'pos2' =>0, 'pos3' =>9, 'pos4' =>1, 'pos5' =>6, 'pos6' =>2, 'pos7' =>5, 'pos8' =>3, 'pos9' =>8, 'pos10' =>7]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>15, 'pos1' =>3, 'pos2' =>4, 'pos3' =>7, 'pos4' =>5, 'pos5' =>1, 'pos6' =>6, 'pos7' =>2, 'pos8' =>8, 'pos9' =>0, 'pos10' =>9]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>16, 'pos1' =>1, 'pos2' =>0, 'pos3' =>5, 'pos4' =>2, 'pos5' =>9, 'pos6' =>3, 'pos7' =>4, 'pos8' =>7, 'pos9' =>6, 'pos10' =>8]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>17, 'pos1' =>6, 'pos2' =>0, 'pos3' =>3, 'pos4' =>1, 'pos5' =>2, 'pos6' =>4, 'pos7' =>8, 'pos8' =>5, 'pos9' =>7, 'pos10' =>9]);
        DB::table('diez_equipos')->insert([ 'jornada_id' =>18, 'pos1' =>9, 'pos2' =>2, 'pos3' =>0, 'pos4' =>3, 'pos5' =>5, 'pos6' =>6, 'pos7' =>1, 'pos8' =>7, 'pos9' =>4, 'pos10' =>8]);

    }
}
