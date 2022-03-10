<template>
    <div class="container my-5">
        <div class="clearflex">
            <div class="float-right">
                <router-link :to="{name: 'confederacion', params:{id: pais.confederacion.id}}">
                    <a class="font-weight-bold text-sky">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 25px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Regresar
                    </a>
                </router-link>
            </div>
        </div>

        <h1 class="text-sky mb-2 row">
            <div class="col-2 text-center">
                <img :src="`${pais.images.escudo}`" alt="" width="100px">
            </div>

            <div class="col-10 center-align">
                {{pais.federacion}}
            </div>
        </h1>

        <hr>

        <div class="row align-items-start mt-4">
            <div class="col-md-8">
                <div>
                    <mapa-component></mapa-component>
                </div>
            </div>

            <aside class="col-md-4">
                <div class="text-center bg-sky">
                    <h2 class="text-center text-white py-2 my-0">Jersey</h2>
                </div>

                <div class="text-center border">
                    <img :src="`${pais.images.jersey}`" alt="">
                </div>

                <div class="p-4 bg-sky">
                    <h3 class="text-center text-white mb-4 mt-2 ">Mas información</h3>

                    <table class="table table-condensed text-center text-white">
                        <thead>
                            <tr class="bg-primary">
                                <th>Puntos</th>
                                <th>JJ</th>
                                <th>JG</th>
                                <th>JE</th>
                                <th>JP</th>
                                <th>GF</th>
                                <th>GC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-weight-bold">
                                <td scope="row">{{pais.puntos}}</td>
                                <td>{{pais.jj}}</td>
                                <td>{{pais.jg}}</td>
                                <td>{{pais.je}}</td>
                                <td>{{pais.jp}}</td>
                                <td>{{pais.gf}}</td>
                                <td>{{pais.gc}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </aside>
        </div>
    </div>
</template>

<script>
import MapaComponent from './MapaComponent.vue';

export default {
    components: { MapaComponent },
    data() {
        return {
            conf_id: 0
        }
    },
    mounted() {
        this.conf_id = this.$route.params.id;

        axios.get(`/api/paises/${this.conf_id}`).then(res => {
            this.$store.commit('agregar_paises', res.data)
        }).catch(e => console.error(e.message));
    },
    computed:{
        pais(){
            return this.$store.state.pais;
        }
    }
}
</script>
