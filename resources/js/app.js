/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import store from './store';
import Books from './components/Books';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

//vue-toaster
import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';

Vue.use(Toaster, {timeout: 2000});

const router = new VueRouter({
    mode: 'history',
    routes: [
    {
        path: '/',
        name: 'home',
        component: Home
    },

    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },

    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },

    {
        path: '/dashboard',
        name: 'dashboard',
        component: Books,
        meta: { requiresAuth: true }
    },
]
});

router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'login' })
        return
    }


    // if logged in redirect to dashboard
    if(to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'dashboard' })
        return
    }

    next()
});

new Vue({
    router,
    store,
    el: '#app',
    render: h => h(App)
});
