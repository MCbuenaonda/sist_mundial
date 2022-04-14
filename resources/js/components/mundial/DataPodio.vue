<template>
    <table style="width: 250px;">
        <tr v-for="(lugar, index) in podio" :key="index">
            <td>
                <a :href="'/pais/'+lugar.pais.id" target="_blank">
                    <strong> {{index = index + 1}}. </strong> 
                    <img :src="lugar.pais.images.icono" alt="" style="width: 35px;"> 
                    {{lugar.nombre}}
                </a>
            </td>
            <td>{{lugar.pais.rankin}} pts</td>
        </tr>
    </table>
</template>

<script>
export default {
    props:['datapodio'],
    data() {
        return {
            podio: JSON.parse(this.datapodio)
        }
    },
    created() {},
}
</script>

<style>

</style>
