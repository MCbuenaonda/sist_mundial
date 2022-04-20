<template>
    <div class="row">
        <div class="col-md-12" v-for="(inversion,index) in dataCuenta.inversiones" :key="index">
            <div class="card bg-dark">
                <div class="card-body">
                    <div class="text-center">
                        <p class="m-0 text-sky">{{inversion.pais.nombre}}</p>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12 my-1" v-for="(historia,ind) in inversion.historia" :key="ind">
                            <div class="card conf-dark-mode">
                                <div class="card-body row p-1">
                                    <div class="col-md-12 row">
                                        <div class="col-md-4">
                                            <p>{{historia.fecha}}</p>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <p> Estadio {{historia.ciudad.estadio}} {{historia.ciudad.nombre}}, {{historia.paisL.siglas}}</p>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <p>{{historia.fase.descripcion}}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-5 text-right">
                                        <p class="m-0">
                                            <span class="text-gray">{{historia.paisL.nombre}}</span>
                                            <img :src="historia.paisL.images.icono" alt="" style="width: 10%;">
                                        </p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <h5 class="m-0">{{historia.gol_l}} - {{historia.gol_v}}</h5>
                                    </div>
                                    <div class="col-md-5 text-left">
                                        <p class="m-0">
                                            <img :src="historia.paisV.images.icono" alt="" style="width: 10%;">
                                            <span class="text-gray">{{historia.paisV.nombre}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['cuenta'],
    data() {
        return {
            dataCuenta: JSON.parse(this.cuenta)
        }
    },
    created(){
        this.dataCuenta.inversiones.forEach(element => {
            element.historia = element.historia.filter(s => s.activo > 0).sort((a, b) => a.fecha - b.fecha);
            console.log();
        });
    }

}
</script>

<style>

/*

 */
</style>
