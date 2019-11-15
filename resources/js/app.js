require('./bootstrap');
//import axios from 'axios';

window.Vue = require('vue');

Vue.component('app', require('./components/App.vue').default);
const app = new Vue({
    el: '#app',
});
