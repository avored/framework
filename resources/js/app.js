
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//window._ = require('lodash');
require('popper.js');

try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');

} catch (e) {}

require('select2');
require('pc-bootstrap4-datetimepicker');
require('chartjs');
require('sweetalert');
require('jquery-sortable');

window.SimpleMDE = require('simplemde');
window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

Vue.component('avored-form-input', require('../components/forms/avored-form-input.vue'));
Vue.component('avored-form-select', require('../components/forms/avored-form-select.vue'));
Vue.component('avored-form-textarea', require('../components/forms/avored-form-textarea.vue'));

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
