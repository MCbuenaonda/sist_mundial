<template>
    <div class="animate__animated animate__fadeIn card text-left p-4 mb-5 shadow card-hover" :class="this.conf.nombre.toLowerCase()">
        <div class="animate__animated animate__fadeIn">
            <h1 class="font-weight-bold">{{ this.conf.nombre }}</h1>
            <h2>{{ this.conf.region }}</h2>
            <p>{{ this.conf.descripcion }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['confederacion'],
    data(){
        return {
            conf: JSON.parse(this.confederacion)
        }
    },
    mounted(){
        console.log(this.conf.nombre.toLowerCase()  );
    }
}
</script>
