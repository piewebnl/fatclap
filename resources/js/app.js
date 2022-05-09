/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require("vue");

import App from './App.vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import vueDebounce from 'vue-debounce'
import VueCookies from 'vue-cookies'
import Paginate from 'vuejs-paginate'

// Use Vuex store
import store from "./store/store";

// Use axios with CamelCase (Js) to snake_case convert (Laravel)
import axios from 'axios';
import applyCaseMiddleware from 'axios-case-converter';
Vue.prototype.$axios = applyCaseMiddleware(axios.create({ headers: { 'X-Requested-With': 'XMLHttpRequest' } }));

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(vueDebounce);
Vue.use(VueCookies)
Vue.component('paginate', Paginate)



Vue.config.productionTip = true;
Vue.config.devtools = true;

import routes from './routes/routes'
const router = new VueRouter(routes);


if (document.getElementById('app')) {

    const app = new Vue({
        el: '#app',
        store: store,
        router,
        components: {
            App
        },
        render: h => h(App)
    });

}
