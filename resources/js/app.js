/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
// window.Vue = require('vue');
window.Vue = require('vue').default;

// font-awesome
import { library } from '@fortawesome/fontawesome-svg-core';
import { faTrash, faPlusSquare } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faTrash, faPlusSquare);

Vue.component('font-awesome-icon', FontAwesomeIcon);

// Bootstrap-vue
// Docs: https://bootstrap-vue.org/docs
import { BootstrapVue, ModalPlugin, LayoutPlugin, CalendarPlugin, FormSelectPlugin } from 'bootstrap-vue';
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// <b-modal> 
Vue.use(ModalPlugin);
// <b-container>, <b-row>, <b-col>
Vue.use(LayoutPlugin);
// b-calendar
Vue.use(CalendarPlugin);
// b-select
Vue.use(FormSelectPlugin);


// import "@fullcalendar/core/vdom"; // solves problem with Vite
// import { FullCalendar } from "@fullcalendar/vue";
// import { dayGridPlugin } from "@fullcalendar/daygrid";
// import { interactionPlugin } from "@fullcalendar/interaction";
// import Vue from 'vue';
// // Vue.use(FullCalendar);
// // Vue.use(dayGridPlugin);
// // Vue.use(interactionPlugin);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('index-component', require('./components/Index.vue').default);

const app = new Vue({
    el: '#app',
});
