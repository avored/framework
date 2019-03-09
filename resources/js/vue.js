
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//window._ = require('lodash');
//require('popper.js');

try {
    //window.$ = window.jQuery = require('jquery');
    //require('bootstrap');

} catch (e) {}

//require('select2');
//require('pc-bootstrap4-datetimepicker');
//require('chartjs');
//require('sweetalert');
//require('jquery-sortable');

//window.SimpleMDE = require('simplemde');


window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}



Vue.component('datagrid', require('../components/datagrid/DataGrid.vue').default);
Vue.component('sidebar-dropdown', require('../components/layout/SideBarDropdown.vue').default);


Vue.component('login-page', require('../components/user/auth/LoginPage.vue').default);
Vue.component('password-reset-page', require('../components/user/auth/PasswordResetPage.vue').default);
Vue.component('set-new-password-page', require('../components/user/auth/SetNewPasswordPage.vue').default);
Vue.component('admin-user-field-page', require('../components/user/admin-user/AdminUserFieldPage.vue').default);

Vue.component('country-field-page', require('../components/system/country/CountryFieldPage.vue').default);
Vue.component('state-field-page', require('../components/system/state/StateFieldPage.vue').default);
Vue.component('site-currency-field-page', require('../components/system/site-currency/SiteCurrencyFieldPage.vue').default);

Vue.component('category-field-page', require('../components/product/category/CategoryFieldPage.vue').default);
Vue.component('attribute-field-page', require('../components/product/attribute/AttributeFieldPage.vue').default);

Vue.component('cms-page-field-page', require('../components/cms/page/CmsPageFieldPage.vue').default);
Vue.component('order-status-field-page', require('../components/order/order-status/OrderStatusFieldPage.vue').default);

//require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
const app = new Vue({
    el: '#app',
    data: {
        toggleSideBarData: true,
        displayProfileHeaderMenu: false
    },
    methods: {
        toggleSidebar() {
            this.toggleSideBarData = !this.toggleSideBarData;
        },
        clickOnProfileHeaderLink() {
            this.displayProfileHeaderMenu = !this.displayProfileHeaderMenu;        
        }
     }
});
