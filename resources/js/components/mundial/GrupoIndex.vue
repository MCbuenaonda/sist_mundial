<template>
  <div>
      <h4 class="text-sky">Grupo {{grupo[0].grupo.nombre}}</h4>

        <table class="table table-hover table-sm">
            <thead class="table-head conf-dark-mode">
                <tr>
                    <th>Pais</th>
                    <th>Pts</th>
                    <th>JJ</th>
                    <th>JG</th>
                    <th>JE</th>
                    <th>JP</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in grupo" :key="index" :class="((data.pais.nombre == juego.paisL.nombre) || (data.pais.nombre == juego.paisV.nombre)) ? 'bg-success' : ''">
                    <td scope="row">
                        <img :src="data.pais.images.icono" alt="" style="width: 35px;">
                        {{data.pais.nombre}}
                    </td>
                    <td class="font-weight-bold">{{data.puntos}}</td>
                    <td>{{data.jj}}</td>
                    <td>{{data.jg}}</td>
                    <td>{{data.je}}</td>
                    <td>{{data.jp }}</td>
                </tr>
            </tbody>
        </table>

        <hr>
    </div>
</template>

<script>
export default {
    props:['datagrupo','datajuego'],
    data() {
        return {
            grupo: JSON.parse(this.datagrupo),
            juego: JSON.parse(this.datajuego)
        }
    },
    created(){}
}
</script>

<style>

</style>
