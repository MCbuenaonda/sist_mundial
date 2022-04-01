<template>
    <div class="">
        <h4 class="text-sky">Partido anterior</h4>

        <div class="conf-dark-mode p-3">
            <div class="row">
                <div class="col-md-4">
                    <bandera-modal :juego="JSON.stringify(anterior)" :pais="JSON.stringify(anterior.PaisL)" :images="JSON.stringify(anterior.PaisL.images)"></bandera-modal>
                </div>
                <div class="col-md-4 pt-3">
                    <h3>{{anterior.gol_l}} - {{anterior.gol_v}}</h3>
                </div>
                <div class="col-md-4">
                    <bandera-modal :juego="JSON.stringify(anterior)" :pais="JSON.stringify(anterior.PaisV)" :images="JSON.stringify(anterior.PaisV.images)"></bandera-modal>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12" v-for="(action, index) in logJuego" :key="index" :class="(action.posesion == 'L') ? 'text-left':'text-right'">
                    <div v-if="action.posesion == 'L'">
                        <b>{{action.minuto}}`</b>
                        <small> {{action.Jugador.nombre}} </small>
                    </div>

                    <div class="m-0" v-if="action.posesion == 'V'">
                        <small> {{action.Jugador.nombre}} </small>
                        <b>{{action.minuto}}`</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['dataanterior','datalogjuegos'],
    data() {
        return {
            anterior: JSON.parse(this.dataanterior),
            logJuego: JSON.parse(this.datalogjuegos),
        }
    },
    created() {},
}
</script>

<style>

</style>
