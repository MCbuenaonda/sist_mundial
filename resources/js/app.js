/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'animate.css';

require('./bootstrap');

window.Vue = require('vue');

import router from './router'
import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
import Vue from 'vue';
import VueGoogleCharts from 'vue-google-charts'

Vue.use(VueGoogleCharts)
    /**
     * The following block of code may be used to automatically register your
     * Vue components. It will recursively scan this directory for the Vue
     * components and automatically register them with their "basename".
     *
     * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
     */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('pagina-inicio', require('./components/PaginaInicio.vue').default);
Vue.component('confederacion-card', require('./components/mundial/ConfederacionCard.vue').default);
Vue.component('pais-modal', require('./components/mundial/PaisModal.vue').default);
Vue.component('bandera-modal', require('./components/mundial/BanderaModal.vue').default);
Vue.component('acciones-list', require('./components/mundial/AccionesList.vue').default);
Vue.component('calendario-view', require('./components/mundial/CalendarioView.vue').default);
Vue.component('auto-timer', require('./components/mundial/AutoTimer.vue').default);
Vue.component('carousel-games', require('./components/mundial/CarouselGames.vue').default);
Vue.component('data-jugador', require('./components/mundial/DataJugador.vue').default);
Vue.component('data-podio', require('./components/mundial/DataPodio.vue').default);
Vue.component('normal-body', require('./components/mundial/NormalBody.vue').default);
Vue.component('campeon-body', require('./components/mundial/CampeonBody.vue').default);
Vue.component('juego-anterior', require('./components/mundial/JuegoAnterior.vue').default);
Vue.component('grupo-index', require('./components/mundial/GrupoIndex.vue').default);
Vue.component('dream-team', require('./components/mundial/DreamTeam.vue').default);
Vue.component('cuenta-section', require('./components/mundial/CuentaSection.vue').default);
Vue.component('v-calendar', Calendar);
//Vue.component('v-date-picker', DatePicker);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data: {
        selectedDate: null,
    }
});
