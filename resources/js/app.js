// import Vue from 'vue';
// import Appi from './Appi';
// import VueRouter from 'vue-router';
// import routes from './router';
// import store from "./store";
// import Paginate from 'vuejs-paginate';
// import VueProgressBar from "vue-progressbar";
//
// Vue.use(VueRouter);
// Vue.component('paginate', Paginate);
//
//
// const options = {
//     color: '#be5683',
//     failedColor: '#874b4b',
//     thickness: '5px',
//     transition: {
//         speed: '0.2s',
//         opacity: '0.6s',
//         termination: 300
//     },
//     autoRevert: true,
//     location: 'top',
//     inverse: false,
//     position: 'relative',
//     height: '5px'
// };
//
// Vue.use(VueProgressBar, options);
//
// const app = new Vue({
//     el: '#app',
//     router: new VueRouter(routes),
//     store,
//     components: {
//         Appi
//     }
// });
import axios from 'axios';
import Vue from 'vue';
import VueAuth from '@websanova/vue-auth';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import auth from './auth';
import router from './router';

window.Vue = Vue;
Vue.router = router;
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
axios.defaults.baseURL = `http://lappinalle.test/api`;
Vue.use(VueAuth, auth);

import Appi from './Appi';
import store from "./store";
import Paginate from 'vuejs-paginate';
import VueProgressBar from "vue-progressbar";

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
    store,
    router,
    components: {
        Appi
    }
});
