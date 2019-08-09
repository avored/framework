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
import VueQuillEditor from 'vue-quill-editor'
import Vddl from 'vddl'

Vue.use(Vddl)
Vue.use(Antd)
Vue.use(VueQuillEditor);

Vue.component('order-table', require('../components/order/order/OrderTable.vue').default);

Vue.component('language-table', require('../components/system/language/LanguageTable.vue').default);
Vue.component('language-save', require('../components/system/language/LanguageSave.vue').default);

Vue.component('user-group-table', require('../components/user/user-group/UserGroupTable.vue').default);
Vue.component('user-group-save', require('../components/user/user-group/UserGroupSave.vue').default);

Vue.component('tax-group-table', require('../components/system/tax-group/TaxGroupTable.vue').default);
Vue.component('tax-group-save', require('../components/system/tax-group/TaxGroupSave.vue').default);

Vue.component('tax-rate-table', require('../components/system/tax-rate/TaxRateTable.vue').default);
Vue.component('tax-rate-save', require('../components/system/tax-rate/TaxRateSave.vue').default);

Vue.component('attribute-table', require('../components/catalog/attribute/AttributeTable.vue').default);
Vue.component('attribute-save', require('../components/catalog/attribute/AttributeSave.vue').default);

Vue.component('property-table', require('../components/catalog/property/PropertyTable.vue').default);
Vue.component('property-save', require('../components/catalog/property/PropertySave.vue').default);

Vue.component('product-table', require('../components/catalog/product/ProductIndex.vue').default);
Vue.component('product-save', require('../components/catalog/product/ProductSave.vue').default);

Vue.component('state-table', require('../components/system/state/StateTable.vue').default);
Vue.component('state-save', require('../components/system/state/StateSave.vue').default);

Vue.component('currency-table', require('../components/system/currency/CurrencyIndex.vue').default);
Vue.component('currency-save', require('../components/system/currency/CurrencySave.vue').default);

Vue.component('category-table', require('../components/catalog/category/CategoryTable.vue').default);
Vue.component('category-save', require('../components/catalog/category/CategorySave.vue').default);

Vue.component('configuration-save', require('../components/system/configuration/ConfigurationSave.vue').default);

Vue.component('menu-save', require('../components/cms/menu/MenuSave.vue').default);
Vue.component('menu-table', require('../components/cms/menu/MenuTable.vue').default);

Vue.component('page-table', require('../components/cms/page/PageTable.vue').default);
Vue.component('page-save', require('../components/cms/page/PageSave.vue').default);

Vue.component('order-status-table', require('../components/order/order-status/OrderStatusTable.vue').default);
Vue.component('order-status-save', require('../components/order/order-status/OrderStatusSave.vue').default);

Vue.component('role-index', require('../components/system/role/RoleTable.vue').default);
Vue.component('system-role-save', require('../components/system/role/RoleSave.vue').default);

Vue.component('admin-user-table', require('../components/system/admin-user/AdminUserTable.vue').default);
Vue.component('admin-user-save', require('../components/system/admin-user/AdminUserSave.vue').default);

Vue.component('avored-layout', require('../components/system/Layout.vue').default);
Vue.component('avored-flash', require('../components/system/Flash.vue').default);
Vue.component('login-fields', require('../components/system/LoginFields.vue').default);
Vue.component('password-reset-page', require('../components/system/PasswordResetPage.vue').default);
Vue.component('password-new-page', require('../components/system/PasswordNewPage.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
