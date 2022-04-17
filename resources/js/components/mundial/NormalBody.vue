<template>
    <div>
        <div class="card shadow conf-dark-mode mb-2">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <h5>Disponible: $ {{cuenta.disponible}}</h5>
                    </div>
                    <div class="col-md-4">
                        <h5>Invertido: $ {{cuenta.invertido}}</h5>
                    </div>
                </div>
            </div>
        </div>

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
                            <a :href="'/pais/'+juego.paisL.id" target="_blank">
                                <pais-modal v-on:tengo_cuentas="onCuentas" :juego="JSON.stringify(juego)" :pais="JSON.stringify(juego.paisL)" :images="JSON.stringify(juego.paisL.images)"></pais-modal>
                            </a>

                            <div id="div-btn-sell-l">
                                <button type="button" name="" @click="getCompra(juego.paisL.id, juego.paisL.bolsa.precio)" id="btn-accion-l" class="btn-sell btn btn-outline-primary btn-sm btn-block">Comprar - $ {{juego.paisL.bolsa.precio}}</button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <h4 class="mt-5">VS</h4>
                            <p v-if="juegoGlobal != null">({{juegoGlobal.gol_v}} - {{juegoGlobal.gol_l}})</p>
                        </div>
                        <div class="col-md-5">
                            <a :href="'/pais/'+juego.paisV.id" target="_blank">
                                <pais-modal v-on:tengo_cuentas="onCuentas" :juego="JSON.stringify(juego)" :pais="JSON.stringify(juego.paisV)" :images="JSON.stringify(juego.paisV.images)"></pais-modal>
                            </a>

                            <div id="div-btn-sell-v">
                                <button type="button" name="" @click="getCompra(juego.paisV.id, juego.paisL.bolsa.precio)" id="btn-accion-v" class="btn-sell btn btn-outline-primary btn-sm btn-block">Comprar - $ {{juego.paisV.bolsa.precio}}</button>
                            </div>
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
    </div>
</template>

<script>
//import { db } from "../../firebase";
import Swal from 'sweetalert2'
export default {
    props:['datajuego','datamundial','datajuegoglobal','dataconfig','datacuenta'],
    data() {
        return {
            juego: JSON.parse(this.datajuego),
            mundial: JSON.parse(this.datamundial),
            juegoGlobal: JSON.parse(this.datajuegoglobal),
            config: JSON.parse(this.dataconfig),
            cuenta: JSON.parse(this.datacuenta),
            paisjuego: ''
        }
    },
    created() {},
    methods: {
        //...mapActions(['getCnfData'])
        onCuentas(datos){
            if (datos.length > 0) {
                datos.forEach(element => {
                    this._getLabelCompra(element.pais_id);
                });
            }
        },
        getCompra(pais_id, pais_precio){
            if (pais_precio <= this.cuenta.disponible) {
                const inversion = {
                    pais_id: pais_id,
                    cuenta_id: this.cuenta.id,
                    inversion: pais_precio
                }

                axios.post(`/api/compra`, inversion).then(res => {
                    this._getLabelCompra(pais_id);

                    Swal.fire({
                        icon: 'success',
                        title: 'Hecho',
                        text: 'Tu compra se ha realizado!',
                    })
                }).catch(e => console.log(e.message));
                /*
                axios.get(`/api/detalles/${this.objJuego.id}`).then(res => {
                    this.infoGrupo = res.data;
                    this.infoPais = this.infoGrupo.find(i => i.pais.nombre === this.objPais.nombre);
                    this.$emit('tengo_cuentas', this.infoPais.pais.cuentas);
                }).catch(e => console.log(e.message));*/
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tu saldo es insuficiente!',
                })
            }

        },
        _getLabelCompra(pais_id){
            if (pais_id == this.juego.pais_id_l) {
                $('.btn-sell').attr('hidden', true);
                $('#div-btn-sell-l').append(`<p><small class="text-success">Comprado</small></p>`);
            }

            if (pais_id == this.juego.pais_id_v) {
                $('.btn-sell').attr('hidden', true);
                $('#div-btn-sell-v').append(`<p><small class="text-success">Comprado</small></p>`);
            }
        }
    },
    computed: {
        //...mapState(['cnfdata']),
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
