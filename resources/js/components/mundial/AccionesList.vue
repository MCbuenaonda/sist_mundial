<template>
    <div>
        <div class="text-center">
            <span class="badge badge-dark badge-pill">
                <h4 class="m-0 text-gray">{{mingame}}'</h4>
            </span>
        </div>

        <div v-if="viewtable">
            <div class="row text-center text-white">
                <div class="col-md-2">
                    <img :src="juego.paisL.images.jersey" alt="" style="width: 47%;">
                </div>
                <div class="col-md-3 my-auto">
                    <h5>{{juego.paisL.nombre}}</h5>
                </div>
                <div class="col-md-2 my-auto">
                    <h5 class="text-white" style="font-size: 4rem;">
                        <span class="text-sky" :class="class_gol_l">{{gol_l}}</span> - <span class="text-sky" :class="class_gol_v">{{gol_v}}</span>
                    </h5>
                </div>
                <div class="col-md-3 my-auto">
                    <h5>{{juego.paisV.nombre}}</h5>
                </div>
                <div class="col-md-2">
                    <img :src="juego.paisV.images.jersey" alt="" style="width: 47%;">
                </div>
            </div>

            <table v-if="viewline" class="table table-dark">
                <tr>
                    <td class="text-left">POR</td>
                    <td id="por-l"></td>
                    <td id="por-v"></td>
                    <td class="text-right">POR</td>
                </tr>
                <tr>
                    <td class="text-left">DFI</td>
                    <td id="dfi-l"></td>
                    <td id="dfi-v"></td>
                    <td class="text-right">DFI</td>
                </tr>
                <tr>
                    <td class="text-left">DFD</td>
                    <td id="dfd-l"></td>
                    <td id="dfd-v"></td>
                    <td class="text-right">DFD</td>
                </tr>
                <tr>
                    <td class="text-left">LI</td>
                    <td id="li-l"></td>
                    <td id="li-v"></td>
                    <td class="text-right">LI</td>
                </tr>
                <tr>
                    <td class="text-left">LD</td>
                    <td id="ld-l"></td>
                    <td id="ld-v"></td>
                    <td class="text-right">LD</td>
                </tr>
                <tr>
                    <td class="text-left">MI</td>
                    <td id="mi-l"></td>
                    <td id="mi-v"></td>
                    <td class="text-right">MI</td>
                </tr>
                <tr>
                    <td class="text-left">MC</td>
                    <td id="mc-l"></td>
                    <td id="mc-v"></td>
                    <td class="text-right">MC</td>
                </tr>
                <tr>
                    <td class="text-left">MD</td>
                    <td id="md-l"></td>
                    <td id="md-v"></td>
                    <td class="text-right">MD</td>
                </tr>
                <tr>
                    <td class="text-left">EI</td>
                    <td id="ei-l"></td>
                    <td id="ei-v"></td>
                    <td class="text-right">EI</td>
                </tr>
                <tr>
                    <td class="text-left">DC</td>
                    <td id="dc-l"></td>
                    <td id="dc-v"></td>
                    <td class="text-right">DC</td>
                </tr>
                <tr>
                    <td class="text-left">ED</td>
                    <td id="ed-l"></td>
                    <td id="ed-v"></td>
                    <td class="text-right">ED</td>
                </tr>
            </table>

            
        </div>

        <div >
            <h4 v-for="line in list_view" :key="line.id" >
                <div :id="'line-'+line.minuto" :class="class_view">
                    <img v-if="line.pais != null" :src="line.pais.images.jersey" alt="" style="width: 8%;">
                    {{line.minuto}}' {{line.accion}}
                </div>
            </h4>

            <GChart type="LineChart" :data="chartData" :options="chartOptions"/>
        </div>
    </div>
</template>

<script>
import { GChart } from 'vue-google-charts'
import { db } from "../../firebase";

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
            line_temp: {},
            gol_l: 0,
            gol_v: 0,
            class_view: 'animate__animated animate__fadeInUp',
            class_out: 'animate__animated animate__fadeOutUp',
            dominioL: 0,
            dominioV: 0,
            mingame: 0,
            labels: [],
            dataL: [],
            dataV: [],
            paisL: '',
            paisV: '',
            class_gol_l: '',
            class_gol_v: '',
            loaded: false,
            viewline: false,
            viewtable: true,
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
        db.ref('/relato').remove();

        db.ref('/relato').set(this.page);            
        /*this.page.forEach(item => {
        });*/

        /*db.ref('/relato').on('value', function(items) {
            console.log(items.val());
            let lines_pages = items.val()
            let ind = (items.val().length) - 1
            lines_pages[ind];
        });*/
        
        this.chartData.push(['Minuto', `'${this.juego.paisL.nombre}'`, `'${this.juego.paisV.nombre}'`])
        this.chartData.push(["0'",this.poderiniL,this.poderiniV]);
        this._setDominio(this.poderiniL, this.poderiniV)

        /*let linea = {
            id: 0,
            minuto: 0,
            accion: 'Inicia el partido',
            pais: null
        }*/
        //db.ref('/relato').child(0).set(linea);

        //this.list_view.push(linea)

        /*setTimeout(() => {
            this.list_view = this.list_view.slice(0,0);
        }, 2000);*/


        const tiempo = setInterval(() => {
            this.list_view = this.list_view.slice(0,0);
            const key = this.list_lines.length
            const linea = this.page[key]
            let ind = 0
            //db.ref('/relato').child(key).set(linea);                        
            db.ref('/relato').on('value', function(items) {
                const lines_size = items.numChildren()               
                const lines_pages = items.val()                
                const linea_temp = lines_pages[key];
                console.log(linea_temp);
                db.ref('/relato').child(key).remove();

                //console.log(items.val());
                //let ind = (items.val().length) - 1
            });        
            
            this.setAnimation(linea)

            this.loaded = false;
            this.list_lines.push(linea)
            this.list_view.push(linea)
            
            this.setDominio(linea)

            this.chartData.push([`${linea.minuto}'`,this.dominioL,this.dominioV]);

            if (this.list_lines.length == this.page.length) {
                this.endGame(tiempo)                
            }
        }, this.cnf.tiempo_lapso);
    },
    methods: {
        _setDominio(ptsL, ptsV){
            this.dominioL += ptsL
            this.dominioV += ptsV
        },
        setDominio(linea){
            if (linea.gol == 1) {
                this.class_gol_l = ""
                this.class_gol_v = ""
                if (linea.posesion == 'L') {
                    this.gol_l++
                    this._setDominio(2, 0)
                    this.class_gol_l = "animate__animated animate__bounceIn"
                }
                if (linea.posesion == 'V') {
                    this.gol_v++
                    this._setDominio(0, 2)
                    this.class_gol_v = "animate__animated animate__bounceIn"
                }
            }

            if (linea.grupo == 'A') {
                if (linea.posesion == 'V') { this._setDominio(-1, 2) }
            }

            if (linea.grupo == 'B') {
                if (linea.posesion == 'L') { this._setDominio(1, -1) }
            }

            if (linea.grupo == 'C' || linea.grupo == 'G') {                
                (linea.posesion == 'L') ?  this._setDominio(-1, 1) : this._setDominio(1, -1)

                if (linea.grupo == 'G') {
                    (linea.posesion == 'L') ? this._setDominio(0, 1) : this._setDominio(1, 0) 
                }
            }

            if (linea.grupo == 'D' || linea.grupo == 'E' || linea.grupo == 'F') {
                (linea.posesion == 'L') ? this._setDominio(1, -1) : this._setDominio(-1, 1)
            }
        },
        setAnimation(linea){
            let linea_id = linea.pais.jugador.posicion.siglas.toLowerCase()+'-'+linea.posesion.toLowerCase()
            let txt_aln = (linea.posesion == 'L') ? 'text-left' : 'text-right'
            const txt_clr = (linea.gol == 1) ? 'text-orange' : 'text-lightgray'
            this.mingame = linea.minuto
            let animation = (linea.posesion == 'L') ? 'animate__slideInRight' : 'animate__slideInLeft'
            let idtemp = linea_id.split('-');
            animation = (linea.gol == 1) ? 'animate__bounceIn' : animation

            if (linea.posesion == 'L') {
                animation = (linea.grupo == 'G') ? 'animate__slideInLeft' : animation
                txt_aln = (linea.grupo == 'G') ? 'text-right' : txt_aln
                if (linea.grupo == 'G') {
                    linea_id = idtemp[0]+'-v'
                    $('#'+linea_id).append(`<p class="m-0 animate__animated ${animation} ${txt_aln} ${txt_clr}">${linea.accion} ${linea.minuto}'</p>`);
                }else{
                    $('#'+linea_id).append(`<p class="m-0 animate__animated ${animation} ${txt_aln} ${txt_clr}">${linea.minuto}' ${linea.accion}</p>`);
                }
            }else{
                animation = (linea.grupo == 'G') ? 'animate__slideInRight' : animation
                txt_aln = (linea.grupo == 'G') ? 'text-left' : txt_aln
                if (linea.grupo == 'G') {
                    linea_id = idtemp[0]+'-l'
                    $('#'+linea_id).append(`<p class="m-0 animate__animated ${animation} ${txt_aln} ${txt_clr}">${linea.minuto}' ${linea.accion}</p>`);
                }else{
                    $('#'+linea_id).append(`<p class="m-0 animate__animated ${animation} ${txt_aln} ${txt_clr}">${linea.accion} ${linea.minuto}'</p>`);
                }
            }   
        },
        endGame(tiempo){
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
    }
}
</script>

<style>

</style>
