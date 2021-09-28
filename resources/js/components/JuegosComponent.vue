<template>
    <div class="container my-5">

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="clearflex">
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
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="bg-sky text-white">Juego</h2>
                    <div class="clearfix">
                        <small class="float-left">Fase {{juego.fase_id}}</small>
                        <small class="float-right">Grupo {{juego.grupo.nombre}}</small>
                    </div>
                    <h5>{{juego.fecha}}</h5>
                    <h4>Estadio {{juego.ciudad.estadio}} {{juego.ciudad.nombre}}, {{juego.paisL.siglas}}</h4>
                    <h2>{{minute}} '</h2>
                    <h3>{{juego.paisL.nombre}} {{juego.gol_l}} - {{juego.gol_v}} {{juego.paisV.nombre}}</h3>
                    <button class="btn btn-success" @click="play()">Play</button>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6">
                    <ul class="list-group" id="jugadorL">
                        <li class="list-group-item animate__animated animate__fadeInLeft text-left" v-for="(item, index) in goles_l" :key="index">
                             {{item.nombre}}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group" id="jugadorV">
                        <li class="list-group-item animate__animated animate__fadeInRight text-right" v-for="(item, index) in goles_v" :key="index">
                            {{item.nombre}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            juego: {},
            minute: 0,
            goles_l: [],
            goles_v: [],
        }
    },
    mounted(){
        this._getJuego();
    },
    methods: {
        play(){
            let i = 1;
            let juego = {
                acciones: [],
                partido: this.juego
            };

            const tiempo = setInterval(() => {
                const lov = Math.round(Math.random());
                const tiro = Math.round(Math.random());
                let accion = {};

                accion.gol = 0;
                accion.jugador = '';
                accion.juego_id = this.juego.id;

                this.minute = this._getMinute(i);
                    accion.minuto = this.minute;

                if (lov == 1) {
                    accion.posesion = 'L';
                    if (tiro == 1) {
                        this.juego.gol_l++;
                        const player = this.juego.paisL.jugadores[this._getJugador()];
                        accion.gol = 1;
                        accion.jugador = player.id;
                        this.goles_l.push(player);
                        //document.querySelector('#jugadorL').append(`<li class="list-group-item">${player.nombre}</li>`);
                    }
                }else{
                    accion.posesion = 'V';
                    if (tiro == 1) {
                        this.juego.gol_v++;
                        const player = this.juego.paisV.jugadores[this._getJugador()];
                        accion.gol = 1;
                        accion.jugador = player.id;
                        this.goles_v.push(player);
                        //document.querySelector('#jugadorV').append(`<li class="list-group-item">${player.nombre}</li>`);
                    }
                }

                juego.acciones.push(accion);

                //console.log(this.juego.paisL.jugadores[5].nombre);
                i++;

                if (i == 11) {
                    clearInterval(tiempo);
                    this.minute = 0;
                    axios.post(`/api/juegos`, juego).then(res => {
                        this.goles_l = [];
                        this.goles_v = [];
                        this._getJuego();
                    }).catch(e => console.log(e.message));
                }
            }, 1000);
        },
        _getMinute(period) {
            let minute = 0;
            let max = 0;
            let min = 0;

            switch (period) {
                case 1: max = 9; min = 1; break;
                case 2: max = 10; min = 19; break;
                case 3: max = 20; min = 29; break;
                case 4: max = 30; min = 39; break;
                case 5: max = 40; min = 49; break;
                case 6: max = 50; min = 59; break;
                case 7: max = 60; min = 69; break;
                case 8: max = 70; min = 79; break;
                case 9: max = 80; min = 89; break;
                case 10: max = 90; min = 95; break;
                default: break;
            }

            return Math.floor(Math.random() * (max - min)) + min;
        },
        _getJugador(){
            return Math.floor(Math.random() * (10 - 0)) + 0;
        },
        _getJuego(){
            axios.get(`/api/juegos/1`).then(res => {
                this.juego = res.data;
            }).catch(e => console.log(e.message));
        },
        _continue(){
            this.play()
        }
    },
    computed:{

    }
}
</script>
