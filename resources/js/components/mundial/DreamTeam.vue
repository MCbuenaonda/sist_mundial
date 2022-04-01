<template>
    <div>
        <h5 class="text-sky">Dream Team</h5>

        <div class="conf-dark-mode text-white p-2">
            <div class="row" v-for="(jug, index) in teamog" :key="index">
                <div class="col-md-9" data-toggle="tooltip" data-placement="top" :title="jug[0].pais.nombre">
                    <a :href="'/jugador/'+jug[0].jugador_id">
                        <img :src="jug[0].image.bandera" alt="" style="width: 12%">
                        {{jug[0].nombre}}
                    </a>
                </div>
                <div class="col-md-3">
                    <span class="my-auto">{{jug[0].posicion}}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['datateam'],
    data() {
        return {
            teamog: JSON.parse(this.datateam)
        }
    },
    created(){}
}
</script>

<style>

</style>
