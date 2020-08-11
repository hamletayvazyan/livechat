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

window.axios.interceptors.request.use(
    config => {
        const token = localStorage.getItem("token");
        if (token) {
            config.headers.common["Authorization"] = `Bearer ${token}`;
        }
        return config;
    },
    error => {
        return Promise.reject(error);
    }
);
window.axios.interceptors.response.use(
    response => {
        if (response.status === 200 || response.status === 201) {
            return Promise.resolve(response);
        } else {
            return Promise.reject(response);
        }
    },
    error => {
        if (error.response.status) {
            switch (error.response.status) {
                case 400:
                    store.commit('checkAuth');
                    //do something
                    break;

                case 401:
                    store.commit('checkAuth');
                    router.replace({
                        path: "/login",
                        query: { redirect: router.currentRoute.fullPath }
                    });
                    break;
                case 403:
                    store.commit('checkAuth');
                    router.replace({
                        path: "/login",
                        query: { redirect: router.currentRoute.fullPath }
                    });
                    break;
                case 404:
                    alert('page not exist');
                    break;
                case 502:
                    setTimeout(() => {
                        store.commit('checkAuth');
                        router.replace({
                            path: "/login",
                            query: {
                                redirect: router.currentRoute.fullPath
                            }
                        });
                    }, 1000);
            }
            return Promise.reject(error.response);
        }
    }
);

new Vue({
    router,
    store,
    el: '#app'
}).$mount('#app')
