window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
import Antd from 'ant-design-vue'

Vue.use(Antd);

Vue.component('language-index', require('../components/system/language/LanguageIndex.vue').default);
Vue.component('language-save', require('../components/system/language/LanguageSave.vue').default);

Vue.component('category-table', require('../components/catalog/category/CategoryIndex.vue').default);
Vue.component('category-save', require('../components/catalog/category/CategorySave.vue').default);

Vue.component('role-index', require('../components/system/role/RoleIndex.vue').default);
Vue.component('system-role-save', require('../components/system/role/RoleSave.vue').default);

Vue.component('avored-layout', require('../components/system/Layout.vue').default);
Vue.component('avored-flash', require('../components/system/Flash.vue').default);
Vue.component('login-fields', require('../components/system/LoginFields.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
