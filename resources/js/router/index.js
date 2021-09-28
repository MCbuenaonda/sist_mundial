import Vue from 'vue';
import VueRouter from 'vue-router'; 'vue-router'
import Home from '../components/Home';
import PaisComponent from '../components/PaisComponent'
import ConfederacionComponent from '../components/ConfederacionComponent'
import JuegosComponent from '../components/JuegosComponent'

Vue.use(VueRouter);

const routes = [
    { path:'/', component: Home },
    { path:'/pais/:id', name: 'pais', component: PaisComponent },
    { path:'/confederacion/:id', name: 'confederacion', component: ConfederacionComponent },
    { path:'/juegos', name: 'juegos', component: JuegosComponent }
]

const router = new VueRouter({
    routes
});

export default router;
