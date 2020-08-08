import Vue from 'vue';
import Appi from './Appi';
import VueRouter from 'vue-router';
import routes from './router';
import store from "./store";
Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    store,
    components: {
        Appi
    }
});
