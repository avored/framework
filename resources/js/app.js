window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import i18n from './services/i18n'
// import apolloProvider from './services/apollo'
// import Router from './services/router'
import Router from './services/router'
import Store from './services/store'
import './services/components'

import Vddl from 'vddl'
Vue.use(Vddl)

Vue.component('order-table', require('../components/order/order/OrderTable.vue').default)
Vue.component('order-show', require('../components/order/order/OrderShow.vue').default)

Vue.component('customer-table', require('../components/user/customer/CustomerTable.vue').default)
Vue.component('address-table', require('../components/user/customer/AddressTable.vue').default)

Vue.component('customer-group-table', require('../components/user/customer-group/CustomerGroupTable.vue').default)
Vue.component('customer-group-save', require('../components/user/customer-group/CustomerGroupSave.vue').default)

Vue.component('attribute-table', require('../components/catalog/attribute/AttributeTable.vue').default)
Vue.component('attribute-save', require('../components/catalog/attribute/AttributeSave.vue').default)
Vue.component('property-table', require('../components/catalog/property/PropertyTable.vue').default)
Vue.component('property-save', require('../components/catalog/property/PropertySave.vue').default)

Vue.component('product-table', require('../components/catalog/product/ProductTable.vue').default)
Vue.component('product-save', require('../components/catalog/product/ProductSave.vue').default)

Vue.component('currency-table', require('../components/system/currency/CurrencyTable.vue').default)
Vue.component('currency-save', require('../components/system/currency/CurrencySave.vue').default)

Vue.component('category-table', require('../components/catalog/category/CategoryTable.vue').default)

Vue.component('configuration-save', require('../components/system/configuration/ConfigurationSave.vue').default)

Vue.component('menu-save', require('../components/cms/menu/MenuSave.vue').default)
Vue.component('menu-group-table', require('../components/cms/menu/MenuGroupTable.vue').default)
Vue.component('menu-table', require('../components/cms/menu/MenuTable.vue').default)

Vue.component('page-table', require('../components/cms/page/PageTable.vue').default)
Vue.component('page-save', require('../components/cms/page/PageSave.vue').default)

Vue.component('order-status-table', require('../components/order/order-status/OrderStatusTable.vue').default)
Vue.component('order-status-save', require('../components/order/order-status/OrderStatusSave.vue').default)

Vue.component('role-table', require('../components/system/role/RoleTable.vue').default)
Vue.component('system-role-save', require('../components/system/role/RoleSave.vue').default)

Vue.component('admin-user-table', require('../components/system/admin-user/AdminUserTable.vue').default)
Vue.component('admin-user-save', require('../components/system/admin-user/AdminUserSave.vue').default)

Vue.component('promotion-code-table', require('../components/promotion/promotion-code/PromotionCodeTable.vue').default)
Vue.component('promotion-code-save', require('../components/promotion/promotion-code/PromotionCodeSave.vue').default)

Vue.component('avored-layout', require('../components/system/Layout.vue').default)
Vue.component('avored-flash', require('../components/system/Flash.vue').default)
Vue.component('login-fields', require('../components/system/LoginFields.vue').default)
Vue.component('password-reset-page', require('../components/system/PasswordResetPage.vue').default)
Vue.component('password-new-page', require('../components/system/PasswordNewPage.vue').default)

Vue.component('blog-card', require('../components/content/BlogCard.vue').default)
Vue.component('content-builder', require('../components/content/Builder.vue').default)

const app = new Vue({
    el: '#app',
    router: Router,
    i18n,
    store: Store,
    //apolloProvider
});
