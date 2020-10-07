import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router';
import Appi from './Appi';
import store from "./store";
import Paginate from 'vuejs-paginate';
import VueProgressBar from "vue-progressbar";
import Vuelidate from "vuelidate/src";

Vue.component('paginate', Paginate);
Vue.use(VueRouter);
Vue.use(Vuelidate);

const options = {
    color: '#be5683',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.5s',
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
    render: h => h(Appi),
    components: {
        Appi
    }
});
// export default new Vue({
//     el: '#app',
//     store,
//     router,
//     render: h => h(Appi),
// });

