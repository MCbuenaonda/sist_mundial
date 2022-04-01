<template>
    <div v-if="viewlock">
        <p v-if="this.tipo == 'ini'" id='label-ini'> El juego comienza en <span class="text-sky">{{sec}}</span>s {{cfndata}}</p>
        <p v-if="this.tipo == 'fin'" id='label-fin'> continuando... </p>
    </div>
</template>

<script>

import DataService from "../../services/dataservice"

export default {
    props: ['tipo','config','partidoId'],
    data() {
        return {
            cnf: JSON.parse(this.config),
            sec: 0,
            seconds: 0,
            viewlock: true,
            id: parseInt(this.partidoId),
            cnfdata: []
        }
    },
    created() {
         DataService.getAll().on("value", this.onDataChange);




        
        
        
        
        
        
        
        
        if (this.tipo == 'ini') {
            this.sec = (this.cnf.tiempo_juego / 1000);
            console.log(this.sec);
        }

        if (this.tipo == 'fin') {
            this.sec = (this.cnf.tiempo_siguiente / 1000);
        }

        const tiempo = setInterval(() => {
            this.sec--
            if (this.sec == 0) {
                clearInterval(tiempo);
                this.viewlock = false;
                if (this.tipo == 'ini') {
                    window.location.href = `/mundial/${this.id}`;
                }

                if (this.tipo == 'fin') {
                    window.location.href = `/mundial/${this.id}/next`;
                }
            }
        }, 1000);
    },
    methods: {
        onDataChange(items) {
            let _cnfdata = [];
            items.forEach((item) => {
                let key = item.key;
                let data = item.val();
                _cnfdata.push({
                    id: key,
                    value: data,
                });
            });
            this.cnfdata = _cnfdata;
        },
    },
}
</script>

<style>

</style>