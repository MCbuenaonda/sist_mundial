<template>
    <div>
        <!-- Button trigger modal -->
        <div class="text-center" data-toggle="modal" :data-target="'#exampleModal_'+objPais.id" @click="getDetails()">
            <div class="card p-3 mx-auto" style="width: 50%;">
                <img class="mx-auto" :src="objImages.escudo" alt="" style="width: 100px;">
            </div>

            <h3 class="text-secondary mt-2">{{ objPais.nombre }}</h3>
            <h5>
                <small class="text-gray">{{objPais.fase.lista}}</small>
            </h5>
        </div>

        <!-- Modal -->
        <div class="modal fade" :id="'exampleModal_'+objPais.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ objPais.nombre }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img :src="objImages.jersey" alt="" style="width: 160px;">
                            </div>
                            <div class="col-md-8">
                                <table class="table table-sm">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th class="text-left">Pais</th>
                                            <th>Puntos</th>
                                            <th>JJ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in infoGrupo" :key="index" :class="(item.pais.nombre ===  objPais.nombre) ? 'bg-selected' : ''">
                                            <td scope="row" class="text-left">
                                                <img :src="item.pais.images.icono" alt="" style="width: 30px;">
                                                {{item.pais.nombre}}
                                            </td>
                                            <td>{{item.puntos}}</td>
                                            <td>{{item.jj}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
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
    mounted()  {
        //console.log(this.objPais);
        console.log(this.objPais);
    },
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
