<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fases')->insert([
            'nombre' => 'Fase 1 de eliminatoria',
            'descripcion' => 'Fase 1 de eliminatoria por confederacion',
            'label' => 'Eliminatoria 1',
            'lista' => 'Fase 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fases')->insert([
            'nombre' => 'Fase 2 de eliminatoria',
            'descripcion' => 'Fase 2 de eliminatoria por confederacion',
            'label' => 'Eliminatoria 2',
            'lista' => 'Fase 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fases')->insert([
            'nombre' => 'Fase 3 de eliminatoria',
            'descripcion' => 'Fase 3 de eliminatoria por confederacion',
            'label' => 'Eliminatoria 3',
            'lista' => 'Fase 3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fases')->insert([
            'nombre' => 'Fase 4 de eliminatoria',
            'descripcion' => 'Fase 4 de eliminatoria por confederacion',
            'label' => 'Eliminatoria 4',
            'lista' => 'Fase 4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fases')->insert([
            'nombre' => 'Fase 5 de eliminatoria',
            'descripcion' => 'Fase 5 de eliminatoria por confederacion',
            'label' => 'Eliminatoria 5',
            'lista' => 'Fase 5',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fases')->insert([
            'nombre' => 'Partidos de Repechaje para Clasificacion al Mundial',
            'descripcion' => 'Partidos de Repechaje para Clasificacion al Mundial',
            'label' => 'Repechaje',
            'lista' => 'Repechaje',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fases')->insert([
            'nombre' => 'Fase de grupos en Mundial',
            'descripcion' => 'Fase de grupos en Mundial',
            'label' => 'Grupos',
            'lista' => 'Grupos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fases')->insert([
            'nombre' => 'Octavos de final',
            'descripcion' => 'Fase de Octavos de final en Mundial',
            'label' => 'Octavos',
            'lista' => 'Octavos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fases')->insert([
            'nombre' => 'Cuartos de final',
            'descripcion' => 'Fase de Cuartos de final en Mundial',
            'label' => 'Cuartos',
            'lista' => 'Cuartos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fases')->insert([
            'nombre' => 'Semifinal',
            'descripcion' => 'Fase de Semifinal en Mundial',
            'label' => 'Semifinal',
            'lista' => 'Semifinal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fases')->insert([
            'nombre' => 'Final',
            'descripcion' => 'Fase Final en Mundial',
            'label' => 'Final',
            'lista' => 'Final',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
