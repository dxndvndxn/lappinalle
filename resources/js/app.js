import Vue from 'vue';
import Appi from './Appi';
import VueRouter from 'vue-router';
import routes from './router';
import store from "./store";
import Paginate from 'vuejs-paginate';
// import 'es6-promise/auto';
// import axios from 'axios';
// import VueAuth from '@websanova/vue-auth';
// import VueAxios from 'vue-axios';
// import auth from './auth';
import VueProgressBar from "vue-progressbar";

// Set Vue globally
// window.Vue = Vue;

// Vue.router = routes;
Vue.use(VueRouter);

// Set Vue authentication
// Vue.use(VueAxios, axios);
// axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/v1`;

// Vue.use(VueAuth, auth);
Vue.component('paginate', Paginate);


const options = {
    color: '#be5683',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false,
    position: 'relative',
    height: '5px'
};

Vue.use(VueProgressBar, options);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    store,
    components: {
        Appi
    }
});
