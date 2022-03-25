<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeed::class);
        $this->call(ConfederacionSeed::class);
        $this->call(PaisSeed::class);
        $this->call(CiudadSeed::class);
        $this->call(PosicionSeed::class);
        $this->call(JugadorSeed::class);
        $this->call(FaseSeed::class);
        $this->call(FasesConfederacionSeed::class);
        $this->call(GrupoSeed::class);
        $this->call(JornadaSeed::class);
        $this->call(GruposFaseSeed::class);
        $this->call(JornadasGrupoSeed::class);
        $this->call(FechaLimiteSeed::class);
        $this->call(FechaSeed::class);
        $this->call(DosEquipoSeed::class);
        $this->call(TresEquipoSeed::class);
        $this->call(CuatroEquipoSeed::class);
        $this->call(CincoEquipoSeed::class);
        $this->call(SeisEquipoSeed::class);
        $this->call(OchoEquipoSeed::class);
        $this->call(DiezEquipoSeed::class);
        $this->call(AccionSeed::class);
        $this->call(ConfiguracionSeed::class);
    }
}
