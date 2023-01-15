import Vue from 'vue'
//Vue-router
import router from "./router";
//Vuex
import store from "./store";
//Vuetify
import Vuetify from 'vuetify'
import "vuetify/dist/vuetify.min.css"
import "@mdi/font/css/materialdesignicons.min.css"
Vue.use(Vuetify);

import App from "./App.vue";


require('./bootstrap');


const app=new Vue({
    router,
    store,
    vuetify:new Vuetify({
        theme: {
            themes: {
                light: {
                    primary: '#3272C0',
                    secondary: '#b71c1c',
                    accent: '#b71c1c',
                    error: '#DC5A63',
                    info: '#b71c1c',
                    success: '#b71c1c',
                    warning: '#b71c1c',
                },
            },
        },
    }),
    render: function (h) { return h(App) }
}).$mount('#app')
