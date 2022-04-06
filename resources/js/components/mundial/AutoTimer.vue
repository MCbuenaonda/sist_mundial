<template>
    <div v-if="viewlock">
        <p v-if="this.tipo == 'ini'" id='label-ini'> El juego comienza en <span class="text-sky" id="seconds"></span>s </p>
        <p v-if="this.tipo == 'fin'" id='label-fin'> continuando... </p>
    </div>
</template>

<script>
import { db } from "../../firebase";

export default {
    props: ['tipo','config','partidoId'],
    data() {
        return {
            cnf: JSON.parse(this.config),
            seconds: 0,
            viewlock: true,
            id: parseInt(this.partidoId),
        }
    },
    created() {
        const tiempo_juego = (this.cnf.tiempo_juego / 1000)
        const _tipo = this.tipo;
        const _id = this.id;

        db.ref('/config').once("value", function(items) {
            const _cnfdata = items.val();
            
            if (_cnfdata.timer_ini == 0) {                
                _cnfdata.timer_ini = tiempo_juego;
                db.ref('/config').update({ timer_ini: tiempo_juego });
            }
            
            $('#seconds').html(_cnfdata.timer_ini);

            const tiempo = setInterval(() => {
                _cnfdata.timer_ini--
                $('#seconds').html(_cnfdata.timer_ini);

                db.ref('/config').update({ timer_ini: _cnfdata.timer_ini });

                if (_cnfdata.timer_ini == 0) {
                    clearInterval(tiempo);
                    //this.viewlock = false;
                    if (_tipo == 'ini') {
                        window.location.href = `/mundial/${_id}`;
                    }
    
                    if (_tipo == 'fin') {
                        window.location.href = `/mundial/${_id}/next`;
                    }
                    
                }
            }, 1000);            
        });      
    },
    methods: {},
    computed:{}
}
</script>

<style>

</style>