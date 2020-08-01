import Vue from 'vue'
import App from './App'
import VueRouter from 'vue-router'
import routes from './router'
Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    components: {
        App
    }
});