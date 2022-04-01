<template>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h5><small class="text-lightgray">{{juego.fecha}}</small></h5>
            </div>
            <div class="col-md-6">
                <h4 class="card-title text-center">
                    Estadio {{juego.ciudad.estadio}} {{juego.ciudad.nombre}}, {{pais}}
                </h4>
            </div>
            <div class="col-md-3">
                <h5 class="float-right"><small class="text-lightgray"> {{juego.jornada.nombre}}</small> </h5>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-12">
                <p class="m-0 text-lightgray"># {{ juego.tag }}</p>
                <h5><small class="text-orange">{{juego.fase.descripcion}}</small></h5>

                <div class="row">
                    <div class="col-md-5">
                        <a :href="'/pais/'+juego.paisL.id">
                            <pais-modal :juego="JSON.stringify(juego)" :pais="JSON.stringify(juego.paisL)" :images="JSON.stringify(juego.paisL.images)"></pais-modal>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <h4 class="mt-5">VS</h4>
                        <p v-if="juegoGlobal != null">({{juegoGlobal.gol_v}} - {{juegoGlobal.gol_l}})</p>
                    </div>
                    <div class="col-md-5">
                        <a :href="'/pais/'+juego.paisV.id">
                            <pais-modal :juego="JSON.stringify(juego)" :pais="JSON.stringify(juego.paisV)" :images="JSON.stringify(juego.paisV.images)"></pais-modal>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 pt-5">
                <auto-timer tipo="ini" :config="JSON.stringify(config)" :partido-id="juego.id"></auto-timer>
                <!--
                    <a href="{{ route('mundial.jugar', ['partido' => $juego->id]) }}" class="btn btn-primary btn-lg btn-block">Jugar</a>
                -->
            </div>
        </div>
    </div>
</template>

<script>
//import db from '../../app'
export default {
    props:['datajuego','datamundial','datajuegoglobal','dataconfig'],
    data() {
        return {
            juego: JSON.parse(this.datajuego),
            mundial: JSON.parse(this.datamundial),
            juegoGlobal: JSON.parse(this.datajuegoglobal),
            config: JSON.parse(this.dataconfig),
            paisjuego: ''
        }
    },
    created() {
        this.setJuego();
        /*this.db.ref('users/' + userID).set({
		    first_name: 'laslo',
		    last_name: 'losla',
	    });*/
    },
    methods: {
        async setJuego() {
            try {
                const res = await fetch('https://myapp-7ca51.firebaseio.com/juego.json', {
                    method: 'PUT',
                    headers: {
                        'Content-Type':'application/json'
                    },
                    body: JSON.stringify(this.juego)
                })

                const dataDB = await res.json()
                console.log(dataDB);
            } catch (error) {
                console.log(error);
            }
        }
    },
    computed: {
        pais() {
            if (this.juego.confederacion_id < 8) {
                return this.juego.paisL.siglas
            }else{
                return this.mundial.pais.siglas
            }
        }
    },
}
</script>

<style>

</style>
