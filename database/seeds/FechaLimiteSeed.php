<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FechaLimiteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fecha_limites')->insert([
            'fecha' => '1897-01-10',
            'tipo' => 'A',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fecha_limites')->insert([
            'fecha' => '1900-01-15',
            'tipo' => 'B',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('fecha_limites')->insert([
            'fecha' => '1900-07-09',
            'tipo' => 'C',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
