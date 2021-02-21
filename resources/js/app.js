/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import moment from "moment";

require('./bootstrap');
import VueRouter from 'vue-router';
import router from "./router";
import index from './index';

window.Vue = require('vue');
Vue.use(VueRouter)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import StarRating from "./shared/components/StarRating";
import FatalError from "./shared/components/FatalError";
import ErrorShow from "./shared/components/ErrorShow";
import Success from "./shared/components/Success";
import Vuex from 'vuex'
import storeDefinition from "./store";

Vue.use(Vuex)
Vue.filter('momentAgo', (date) => {
    return moment(date).fromNow()
})
Vue.component('star-rating', StarRating)
Vue.component('fatal-error', FatalError)
Vue.component('error-show', ErrorShow)
Vue.component('success', Success)

const store = new Vuex.Store(storeDefinition)
window.axios.interceptors.response.use(
    (response) => {
        return response
    },
    (error) => {
        if(error.response.status == 401)
        {
            store.dispatch('logout')
        }
        return Promise.reject(error)
    })
const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        index
    },
    async beforeCreate() {
        this.$store.dispatch('loadStoredSearch')
        this.$store.dispatch('loadUserInfo')

        // await axios.post('/login',
        //     {
        //         email: 'rvolkman@example.com',
        //         password: 'password'
        //     },
        // {
        //     headers: {
        //         'Accept': 'application/json',
        //         'Content-type': 'application/json',
        //     }
        // }
        // )
        // await axios.get('/user')
    }
});

