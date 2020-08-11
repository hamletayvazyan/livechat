/**
* default imports
* */
import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import 'es6-promise/auto'

Vue.use(VueRouter)
Vue.use(Vuex)

/**
*   router register
* */
import allRoutes from "./_routes/router.register";
const routes = allRoutes

const router = new VueRouter({
    routes,
    linkExactActiveClass: 'active',
    mode: 'history'
})
router.beforeEach((to, from, next) => {
    store.commit('checkAuth');
    let routeNames = [
        'login',
        'register',
        'app',
    ];
    if (store.state.isLoggedIn) {
        (to.name === 'login' || to.name === 'register') ? next({name: 'users'}) : next();
    } else {
        const checkRoute = routeNames.filter(i => i === to.name);
        (checkRoute.length === 0) ? next({name: 'login'}) : next();
    }
});

const store = new Vuex.Store({
    state: {
        isLoggedIn: false,
        userDetails: {},
        loading: false,
    },
    mutations: {
        checkAuth (state) {
            const token = localStorage.getItem('token');
            state.isLoggedIn = !!token;
        },
        userDetails (state) {
            const user = localStorage.getItem('user');
            state.userDetails = JSON.parse(user);
        },
        loading (state, canLoad) {
            state.loading = canLoad;
        },
    }
})


new Vue({
    router,
    store,
    el: '#app'
}).$mount('#app')
