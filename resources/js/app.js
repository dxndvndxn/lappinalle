import Vue from 'vue';
import Appi from './Appi';
import VueRouter from 'vue-router';
import routes from './router';
Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    components: {
        Appi
    }
});
