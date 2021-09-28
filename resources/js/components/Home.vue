<template>
    <div class="mx-5 justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <div class="clearflex">
                    <h2 class="float-left mt-2 main-title">{{mundial.id}}ª Copa del Mundo - {{mundial.pais.nombre}} {{mundial.anio}}</h2>

                    <div class="float-right">
                        <router-link :to="{name: 'juegos'}">
                            <a class="btn btn-primary btn-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 25px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Jugar
                            </a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="row" id="confs">
            <div class="col-md-4" v-for="conf in confederaciones" :key="conf.id">
                <router-link :to="{name: 'confederacion', params: {id: conf.id}}">
                    <div class="animate__animated animate__fadeIn card text-left p-4 mb-5 shadow card-hover" :class="conf.nombre.toLowerCase()">
                        <div class="animate__animated animate__fadeIn">
                            <h1 class="font-weight-bold">{{ conf.nombre }}</h1>
                            <h2>{{ conf.region }}</h2>
                            <p>{{ conf.descripcion }}</p>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/confederaciones').then(res => {
                this.$store.commit('obtener_confederaciones', res.data);
            }).catch(e => console.log(e.message));

            axios.get('/api/mundiales/1').then(res => {
                this.$store.commit('add_mundial', res.data);
            }).catch(e => console.log(e.message));
        },
        computed: {
            confederaciones() {
                return this.$store.getters.obtenerConfederaciones;
            },
            mundial(){
                return this.$store.getters.obtenerMundial;
            }
        }
    }
</script>
