<template>
    <div>
        <!-- Button trigger modal -->
        <div data-toggle="modal" :data-target="'#flagExampleModal_'+objPais.id" @click="getDetails()">
            <img :src="objImages.bandera" alt="">
            <h5 class="text-secondary mt-2">{{ objPais.nombre }}</h5>
        </div>

        <!-- Modal -->
        <div class="modal fade" :id="'flagExampleModal_'+objPais.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            infoGrupo: {}
        }
    },
    mounted()  {},
    methods: {
        getDetails() {
            axios.get(`/api/detalles/${this.objJuego.id}`).then(res => {
                this.infoGrupo = res.data;
            }).catch(e => console.log(e.message));
        }
    },
}
</script>

<style>

</style>
