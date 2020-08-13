import Vue from 'vue';
import Appi from './Appi';
import VueRouter from 'vue-router';
import routes from './router';
import store from "./store";
import VueProgressBar from "vue-progressbar";
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
    position: 'relative'
};
Vue.use(VueRouter);
Vue.use(VueProgressBar, options);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    store,
    components: {
        Appi
    }
});
