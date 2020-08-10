/*
* default imports
* */
import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import 'es6-promise/auto'

Vue.use(VueRouter)
Vue.use(Vuex)

/*
*   router register
* */
import allRoutes from "./_routes/router.register";
const routes = allRoutes

const router = new VueRouter({
    routes,
    linkExactActiveClass: 'active',
    mode: 'history'
})

const store = new Vuex.Store({
    state: {
        count: 0
    },
    mutations: {
        increment (state) {
            state.count++
        }
    }
})


new Vue({
    router
}).$mount('#app')
