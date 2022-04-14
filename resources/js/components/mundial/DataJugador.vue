<template>
    <table class="table table-bordered table-sm mb-0">
        <tr class="conf-dark-mode text-center">
            <td colspan="2"> <strong class="text-sky">Maximo goleador</strong></td>
        </tr>
        <tr>
            <td class="conf-dark-mode">
                <img :src="dataJugador.pais.images.bandera" alt="">
            </td>
            <td>
                <table class="table table-bordered table-sm mb-0 conf-dark-mode">
                    <tr>
                        <td>
                            <a :href="'/jugador/'+dataJugador.jugador_id" target="_blank">
                                {{dataJugador.nombre}}
                            </a>
                        </td>
                        <td>
                            {{dataJugador.goles}} Goles
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{dataJugador.posicion.nombre}}
                        </td>
                        <td>
                            {{dataJugador.pais.nombre}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</template>

<script>
export default {
    props: ['datos'],
    data() {
        return {
            dataJugador: JSON.parse(this.datos)
        }
    },
    created() {},
}
</script>

<style>

</style>
