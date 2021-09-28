<template>
    <div class="container my-5">

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="clearflex">
                    <h2 class="float-left">Paises de confederacion</h2>

                    <div class="float-right">
                        <router-link to="/">
                            <a class="font-weight-bold text-sky">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 25px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Regresar
                            </a>
                        </router-link>
                    </div>
                </div>
            </div>

            <div class="col-md-2 mt-4" v-for="pais in this.paises" :key="pais.id">
                <router-link :to="{name: 'pais', params: {id: pais.id}}">
                    <div class="card card-pais">
                        <img class="card-img-md" :src="`images/fifa/128/${pais.nombre}.png`" alt="">
                        <div class="animate__animated animate__fadeIn label-pais">
                            <h3 class="font-weight-bold">{{ pais.nombre }}</h3>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted(){
        axios.get(`/api/confederaciones/${this.$route.params.id}`).then(res => {
            this.$store.commit('obtener_paises',res.data.paises);
        }).catch(e => console.warn(e.message));
    },
    computed:{
        paises(){
            return this.$store.state.paises;
        }
    }
}
</script>
