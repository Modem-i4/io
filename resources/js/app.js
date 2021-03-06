/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vuetify from 'vuetify';

window.Vue = require('vue');
window.Vue.use(Vuetify);
window.axios = require('axios');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('users-table', require('./components/UserTableComponent.vue').default);
Vue.component('departments-table', require('./components/InventoryDepartmentsComponent.vue').default);

Vue.component('app-snackbar', require('./components/AppSnackbar.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import uk from "vuetify/lib/locale/uk";

const app = new Vue({
    vuetify: new Vuetify({
        lang: {
            locales: { uk },
            current: 'uk',
        },
    }),
    el: '#app',
});
