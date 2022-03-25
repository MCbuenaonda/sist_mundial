<template>
    <div>
        <div class="row text-center text-white">
            <div class="col-md-2">
                <img :src="juego.paisL.images.jersey" alt="" style="width: 85%;">
            </div>
            <div class="col-md-3 my-auto">
                <h1>{{juego.paisL.nombre}}</h1>
            </div>
            <div class="col-md-2 my-auto">
                <h1 class="text-white" style="font-size: 4rem;">
                    <span :class="class_gol_l">{{gol_l}}</span> - <span :class="class_gol_v">{{gol_v}}</span>
                </h1>
            </div>
            <div class="col-md-3 my-auto">
                <h1>{{juego.paisV.nombre}}</h1>
            </div>
            <div class="col-md-2">
                <img :src="juego.paisV.images.jersey" alt="" style="width: 85%;">
            </div>
        </div>

        <div class="conf-dark-mode p-2 text-center" style="height: 9rem;">
            <h4 v-for="line in list_view" :key="line.id">
                <div :id="'line-'+line.minuto" :class="class_view">
                    <img v-if="line.pais != null" :src="line.pais.images.jersey" alt="" style="width: 8%;">
                    {{line.minuto}}' {{line.accion}}
                </div>
            </h4>
        </div>

        <GChart type="LineChart" :data="chartData" :options="chartOptions" />
    </div>
</template>

<script>
import { GChart } from 'vue-google-charts'
export default {
    props: ['relato','game','poderl','poderv','config'],
    components: {
       GChart
    },
    data(){
        return {
            cnf: JSON.parse(this.config),
            page: JSON.parse(this.relato),
            juego: JSON.parse(this.game),
            poderiniL: parseInt(this.poderl),
            poderiniV: parseInt(this.poderv),
            list_lines: [],
            list_view: [],
            gol_l: 0,
            gol_v: 0,
            class_view: 'animate__animated animate__fadeInUp',
            class_out: 'animate__animated animate__fadeOutUp',
            dominioL: 0,
            dominioV: 0,
            labels: [],
            dataL: [],
            dataV: [],
            paisL: '',
            paisV: '',
            class_gol_l: '',
            class_gol_v: '',
            loaded: false,
            chartData: [],
            chartOptions: {
                backgroundColor: '#1A202B',
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                },
                legend: {
	                textStyle: {
                        color: '#FFF'
                    }
                },
                vAxis: {
	                textStyle:{
                        color: '#FFF'
                    },
	                titleTextStyle:{
                        color: '#FFF'
                    },
                },
                hAxis: {
	                textStyle:{
                        color: '#FFF'
                    },
	                titleTextStyle:{
                        color: '#FFF'
                    }
                },
                height: 400,
            }
        }
    },
    created(){
        this.chartData.push(['Minuto', `'${this.juego.paisL.nombre}'`, `'${this.juego.paisV.nombre}'`])
        this.chartData.push(["0'",this.poderiniL,this.poderiniV]);
        this.dominioL = this.poderiniL;
        this.dominioV = this.poderiniV;

        let linea = {
            id: 0,
            minuto: 0,
            accion: 'Inicia el partido',
            pais: null
        }

        this.list_view.push(linea)

        setTimeout(() => {
            this.list_view = this.list_view.slice(0,0);
            console.log('Quito el incio del partido');
        }, 2000);


        const tiempo = setInterval(() => {
            this.list_view = this.list_view.slice(0,0);
            const linea = this.page[this.list_lines.length];
            this.loaded = false;
            this.list_lines.push(linea)
            this.list_view.push(linea)

            if (linea.gol == 1) {
                this.class_gol_l = ""
                this.class_gol_v = ""
                if (linea.posesion == 'L') {
                    this.gol_l++
                    this.dominioL += 2
                    //this.dominioV--
                    this.class_gol_l = "animate__animated animate__bounceIn"
                }
                if (linea.posesion == 'V') {
                    this.gol_v++
                    //this.dominioL--
                    this.dominioV += 2
                    this.class_gol_v = "animate__animated animate__bounceIn"
                }
            }

            if (linea.grupo == 'A') {
                if (linea.posesion == 'V') {
                    this.dominioL--
                    this.dominioV += 2
                }
            }

            if (linea.grupo == 'B') {
                if (linea.posesion == 'L') {
                    this.dominioL++
                    this.dominioV--
                }
            }

            if (linea.grupo == 'C' || linea.grupo == 'G') {
                if (linea.posesion == 'L') {
                    this.dominioL--
                    this.dominioV++
                }

                if (linea.posesion == 'V') {
                    this.dominioL++
                    this.dominioV--
                }

                if (linea.grupo == 'G') {
                    if (linea.posesion == 'L') { this.dominioV++ }
                    if (linea.posesion == 'V') { this.dominioL++ }
                }
            }

            if (linea.grupo == 'D' || linea.grupo == 'E' || linea.grupo == 'F') {
                if (linea.posesion == 'L') {
                    this.dominioL++
                    this.dominioV--
                }

                if (linea.posesion == 'V') {
                    this.dominioL--
                    this.dominioV++
                }
            }

            this.chartData.push([`${linea.minuto}'`,this.dominioL,this.dominioV]);

            if (this.list_lines.length == this.page.length) {
                setTimeout(() => {
                    this.list_view = this.list_view.slice(-1);
                    const linea = {
                        id: 0,
                        minuto: 0,
                        accion: 'El arbitro marca el final del partido! ...un momento...',
                        pais: null
                    }
                    this.list_view.push(linea);
                    this.list_view = this.list_view.slice(-1);
                    clearInterval(tiempo);

                    setTimeout(() => {
                        window.location.href = `/mundial/${this.juego.id}/next`;
                    }, this.cnf.tiempo_siguiente);
                }, this.cnf.tiempo_lapso);
            }
        }, this.cnf.tiempo_lapso);
    }
}
</script>

<style>

</style>
