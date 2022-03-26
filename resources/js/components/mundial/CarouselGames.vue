<template>
    <carousel :autoplay="true" :nav="false">
        <div class="card conf-dark-mode mx-2" v-for="item in games" :key="item.id">
            <div class="card-body">
                <div class="text-center">
                    <h5 class="card-title" v-if="item.activo == 0">Grupo {{ item.grupo.nombre }}</h5>
                    <p class="m-0" v-if="item.activo == 1">
                        <small><b>{{ item.fecha }}</b></small>
                    </p>
                    <p class="m-0" v-if="item.activo == 1">
                        <small>{{ item.fase.lista }}</small>
                    </p>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <img :src="item.paisL.images.bandera" class="img-fluid rounded-circle mx-auto" alt="" style="width: 65%">
                    </div>
                    <div class="col-md-4">
                        <h4 class="mt-3" v-if="item.activo == 1">{{item.gol_l}} - {{item.gol_v}}</h4>
                    </div>
                    <div class="col-md-4">
                        <img :src="item.paisV.images.bandera" class="img-fluid rounded-circle mx-auto" alt="" style="width: 65%">
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <h5>{{ item.paisL.siglas }}</h5>
                    </div>
                    <div class="col-md-4 p-0">
                        <p v-if="item.activo == 0">{{ item.fecha }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>{{ item.paisV.siglas }}</h5>
                    </div>
                </div>
                <hr v-if="item.activo == 0">
                <div class="clearfix" v-if="item.activo == 0">
                    <div class="float-left">
                        <p><small>Estadio {{ item.ciudad.estadio }} {{ item.ciudad.nombre }}</small></p>
                    </div>
                    <div class="float-right">
                        <p><small>{{ item.jornada.nombre }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </carousel>
</template>

<script>
import carousel from 'vue-owl-carousel'

export default {
    props: ['partidos'],
    components: { carousel },
    data() {
        return {
            games: JSON.parse(this.partidos)
        }
    },
}
</script>

<style>
    .hr-gme {
        margin: 0;
        margin-bottom: 10px;
    }
</style>
