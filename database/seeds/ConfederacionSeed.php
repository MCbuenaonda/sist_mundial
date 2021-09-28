<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfederacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('confederacions')->insert([
            'nombre' => 'UEFA',
            'region' => 'Europa',
            'descripcion' => 'La Unión de Asociaciones Europeas de Fútbol (UEFA), es la confederación europea de asociaciones nacionales de fútbol y máximo ente de este deporte en el continente. Agrupa a 55 asociaciones y es una de las seis confederaciones pertenecientes a la FIFA.',
            'principal' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('confederacions')->insert([
            'nombre' => 'CONMEBOL',
            'region' => 'Sudamérica',
            'descripcion' => 'La Confederación Sudamericana de Fútbol, más conocida como Conmebol, es la confederación de asociaciones (federaciones) de fútbol nacionales de América del Sur. Con diez miembros, es la confederación de la FIFA con la menor cantidad de asociados.',
            'principal' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('confederacions')->insert([
            'nombre' => 'CONCACAF',
            'region' => 'Norte/Centro América y Caribe',
            'descripcion' => 'La Confederación de Norteamérica, Centroamérica y el Caribe de Fútbol, más conocida como Concacaf es la confederación de asociaciones nacionales de fútbol en América del Norte, América Central, las islas del Caribe. Es una de las seis confederaciones pertenecientes a la FIFA.',
            'principal' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('confederacions')->insert([
            'nombre' => 'CAF',
            'region' => 'África',
            'descripcion' => 'La Confederación Africana de Fútbol, también conocida por su acrónimo CAF, es la confederación de asociaciones nacionales de fútbol en África. Es el máximo ente de este deporte en el continente y es una de las seis confederaciones pertenecientes a la FIFA.',
            'principal' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('confederacions')->insert([
            'nombre' => 'OFC',
            'region' => 'Oceanía',
            'descripcion' => 'La Confederación de Fútbol de Oceanía, también conocida por su acrónimo OFC, es la confederación de asociaciones nacionales de fútbol en Oceanía. Fue fundada en 1966 y su sede central se encuentra en Auckland, Nueva Zelanda, es una de las seis confederaciones pertenecientes a la FIFA',
            'principal' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('confederacions')->insert([
            'nombre' => 'AFC',
            'region' => 'Asia',
            'descripcion' => 'La Confederación Asiática de Fútbol, también conocida por su siglas AFC, es la confederación de asociaciones nacionales de fútbol de Asia. fue en 1954 y su sede central se encuentra en Kuala Lumpur, Malasia, es una de las seis confederaciones pertenecientes a la FIFA.',
            'principal' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('confederacions')->insert([
            'nombre' => 'REPECHAJE',
            'region' => 'Internacional',
            'descripcion' => 'Los ultimos dos boletos para la fase final del mundial se juegan en esta fase.',
            'principal' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('confederacions')->insert([
            'nombre' => 'MUNDIAL',
            'region' => 'Internacional',
            'descripcion' => 'Aqui solo juegan los 32 mejores paises de todo el mundo.',
            'principal' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
