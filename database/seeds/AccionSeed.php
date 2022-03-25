<?php

use Illuminate\Database\Seeder;

class AccionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acciones')->insert([ 'grupo' => 'A', 'accion' => 'Peligroso robo de balon que realiza {name}', 'tipo_var' => 'item', 'tipo_pos' => 'ant']);
        DB::table('acciones')->insert([ 'grupo' => 'A', 'accion' => '{name} intercepta el balon en area peligrosa', 'tipo_var' => 'item', 'tipo_pos' => 'ant']);
        DB::table('acciones')->insert([ 'grupo' => 'B', 'accion' => 'Espectacular servicio de {name}', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'B', 'accion' => 'Excelente pase de {name}', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'C', 'accion' => 'Gran disparo de {name} que termina desviado!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'C', 'accion' => '{name} hace un tiro directo... que termina en el portero!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'C', 'accion' => '{name} hace un quiebre que termina por perder el balon!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'C', 'accion' => 'Gran disparo que hace {name}... el balon es bloqueado!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'C', 'accion' => 'La porteria esta sola, {name} dispara... el balon sale desviado!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'C', 'accion' => 'Gran remate de cabeza de {name} que termina desviado!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'C', 'accion' => '{name} dispara... el portero se lanza... el balon termina en el portero!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'C', 'accion' => '{name} controla el balon, se prepara, dispara.... Fuera!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'D', 'accion' => 'Gran disparo de {name} que termina en Gol!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'D', 'accion' => '{name} hace un tiro directo... que termina en Gol!!  ', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'D', 'accion' => '{name} hace un quiebre que termina por vencer al portero, Gol!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'D', 'accion' => 'Gran disparo que hace {name}... el balon termina adentro, Gol!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'D', 'accion' => 'La porteria esta sola, {name} dispara... el balon esta adentro, Gol!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'D', 'accion' => 'Gran remate de cabeza de {name} que termina en Gol!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'D', 'accion' => '{name} dispara... el portero se lanza... el balon termina adentro, Gol!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'D', 'accion' => '{name} controla el balon, se prepara, dispara.... Gol!', 'tipo_var' => 'item', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'E', 'accion' => '{name} realiza un buen pase filtrado', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'E', 'accion' => 'Buena conduccion de balon de {name}', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'E', 'accion' => 'Gran pase que realiza {name}', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => '{name} se filtra al area chica', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => 'Gran oportunidad que genera {name}', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => '{name} deja atras a la defensa', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => '{name} crea gran oportunidad cerca de porteria', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => '{name} pone en apuros a la defensa', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => 'Tiro de esquina cobrado por {name}', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => 'Tiro libre cobrado por {name}', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => 'Gran servicio de {name}', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => 'Buen regate de {name} que deja atras al defensa', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => '{name} realiza un gran centro al area chica', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'F', 'accion' => 'Servicio elevado con peligro que hace {name}', 'tipo_var' => 'var', 'tipo_pos' => 'sin']);
        DB::table('acciones')->insert([ 'grupo' => 'G', 'accion' => 'Buen robo el balon que hace {name} en al area chica', 'tipo_var' => 'item', 'tipo_pos' => 'ant']);
        DB::table('acciones')->insert([ 'grupo' => 'G', 'accion' => 'Buena defensa que realiza {name} que evita el gol', 'tipo_var' => 'item', 'tipo_pos' => 'ant']);
        DB::table('acciones')->insert([ 'grupo' => 'G', 'accion' => '{name} intercepta el balon cerca de la porteria', 'tipo_var' => 'item', 'tipo_pos' => 'ant']);
        DB::table('acciones')->insert([ 'grupo' => 'G', 'accion' => 'Oportuna intervencion de {name} que aleja el gol', 'tipo_var' => 'item', 'tipo_pos' => 'ant']);
        DB::table('acciones')->insert([ 'grupo' => 'G', 'accion' => '{name} tapa el tiro directo a porterial', 'tipo_var' => 'item', 'tipo_pos' => 'ant']);
        DB::table('acciones')->insert([ 'grupo' => 'G', 'accion' => '{name} despeja el balon alejando el peligro', 'tipo_var' => 'item', 'tipo_pos' => 'ant']);
        DB::table('acciones')->insert([ 'grupo' => 'G', 'accion' => 'Gran desvio que hace {name} evitando el gol', 'tipo_var' => 'item', 'tipo_pos' => 'ant']);
    }
}
