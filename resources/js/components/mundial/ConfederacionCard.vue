<template>
    <div class="animate__animated animate__fadeIn card text-left p-1 mb-1 shadow card-hover" :class="[this.conf.nombre.toLowerCase(), this.mode]">
        <div class="animate__animated animate__fadeIn text-center pt-4">
            <h2 class="font-weight-bold text-especial">{{ this.conf.nombre }}</h2>
        </div>
    </div>
</template>

<script>
export default {
    props: ['confederacion'],
    data(){
        return {
            conf: JSON.parse(this.confederacion),
            mode: 'conf-dark-mode'
        }
    },
    mounted(){
        if (this.conf.activo == 0) {
            this.mode = 'bg-dark';
        }
    }
}
</script>
