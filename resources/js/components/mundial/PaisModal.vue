<template>
    <div>
        <!-- Button trigger modal -->
        <div class="text-center">
            <div class="card p-3 mx-auto" style="width: 50%;">
                <img class="mx-auto" :src="objImages.escudo" alt="" style="width: 100px;">
            </div>

            <h3 class="text-secondary mt-2">{{ objPais.nombre }}</h3>
            <h5>
                <small class="text-gray">{{objPais.fase.lista}}</small>
            </h5>
        </div>
    </div>
</template>

<script>
export default {
    props: ['pais','images','juego'],
    data() {
        return {
            objPais: JSON.parse(this.pais),
            objImages: JSON.parse(this.images),
            objJuego: JSON.parse(this.juego),
            infoGrupo: {},
            infoPais: {},
            juegosAnt: []
        }
    },
    mounted()  {},
    methods: {
        getDetails() {
            axios.get(`/api/detalles/${this.objJuego.id}`).then(res => {
                this.infoGrupo = res.data;
                this.infoPais = this.infoGrupo.find(i => i.pais.nombre === this.objPais.nombre);
            }).catch(e => console.log(e.message));
        }
    },
}
</script>

<style>
    .text-gray{
        color: gray !important;
    }
</style>
