import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        paises: [],
        pais: {},
        confederaciones: [],
        mundial: {},
    },
    mutations: {
        obtener_paises(state, paises) {
            state.paises = paises;
        },
        agregar_paises(state, pais) {
            state.pais = pais;
        },
        obtener_confederaciones(state, payload) {
            state.confederaciones = payload;
        },
        add_mundial(state, payload) {
            state.mundial = payload;
        },
    },
    getters: {
        obtenerPais: state => {
            return state.pais;
        },
        obtenerConfederaciones: state => {
            return state.confederaciones;
        },
        obtenerMundial: state => {
            return state.mundial;
        },
    }
});