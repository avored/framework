window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import AvoRed from './avored'
//import router from './router'
//import apolloProvider from './vue-apollo'

window.Vue = require('vue')
window.AvoRed = AvoRed

//import i18n from 'vue-i18n'


import Layout from 'ant-design-vue/lib/layout'
import Menu from 'ant-design-vue/lib/menu'
import Form from 'ant-design-vue/lib/form'
import Select from 'ant-design-vue/lib/select'
import Breadcrumb from 'ant-design-vue/lib/breadcrumb'
import Tabs from 'ant-design-vue/lib/tabs'
import Modal from 'ant-design-vue/lib/modal'
import Notification from 'ant-design-vue/lib/notification'
import Dropdown from 'ant-design-vue/lib/dropdown'

Vue.use(Layout)
Vue.use(Menu)
Vue.use(Form)
Vue.use(Select)
Vue.use(Breadcrumb)
Vue.use(Tabs)
Vue.use(Modal)
Vue.use(Dropdown)


Vue.component('a-date-picker', () => import('ant-design-vue/lib/date-picker'))
Vue.component('a-icon', () => import('ant-design-vue/lib/icon'))
Vue.component('a-avatar', () => import('ant-design-vue/lib/avatar'))
Vue.component('a-row', () => import('ant-design-vue/lib/row'))
Vue.component('a-col', () => import('ant-design-vue/lib/col'))
Vue.component('a-icon', () => import('ant-design-vue/lib/icon'))
Vue.component('a-drawer', () => import('ant-design-vue/lib/drawer'))
Vue.component('a-card', () => import('ant-design-vue/lib/card'))
Vue.component('a-table', () => import('ant-design-vue/lib/table'))
Vue.component('a-button', () => import('ant-design-vue/lib/button'))
Vue.component('a-upload', () => import('ant-design-vue/lib/upload'))
Vue.component('a-upload', () => import('ant-design-vue/lib/upload'))
Vue.component('a-input', () => import('ant-design-vue/lib/input'))
Vue.component('a-switch', () => import('ant-design-vue/lib/switch'))
Vue.component('a-tag', () => import('ant-design-vue/lib/tag'))

Vue.prototype.$notification = Notification;
Vue.prototype.$confirm = Modal.confirm;
Vue.prototype.$info = Modal.info;
Vue.prototype.$success = Modal.success;
Vue.prototype.$error = Modal.error;
Vue.prototype.$warning = Modal.warning;
Vue.prototype.$confirm = Modal.confirm;

import Vddl from 'vddl'
Vue.use(Vddl)

Vue.component('order-table', () => import('../components/order/order/OrderTable.vue'))

Vue.component('language-table', () => import('../components/system/language/LanguageTable.vue'))
Vue.component('language-save', () => import('../components/system/language/LanguageSave.vue'))


Vue.component('user-group-table', () => import('../components/user/user-group/UserGroupTable.vue'))
Vue.component('user-group-save', () => import('../components/user/user-group/UserGroupSave.vue'))

Vue.component('tax-group-table', () => import('../components/system/tax-group/TaxGroupTable.vue'))
Vue.component('tax-group-save', () => import('../components/system/tax-group/TaxGroupSave.vue'))

Vue.component('tax-rate-table', () => import('../components/system/tax-rate/TaxRateTable.vue'))
Vue.component('tax-rate-save', () => import('../components/system/tax-rate/TaxRateSave.vue'))

Vue.component('attribute-table', () => import('../components/catalog/attribute/AttributeTable.vue'))
Vue.component('attribute-save', () => import('../components/catalog/attribute/AttributeSave.vue'))

Vue.component('property-table', () => import('../components/catalog/property/PropertyTable.vue'))
Vue.component('property-save', () => import('../components/catalog/property/PropertySave.vue'))

Vue.component('product-table', () => import('../components/catalog/product/ProductIndex.vue'))
Vue.component('product-save', () => import('../components/catalog/product/ProductSave.vue'))

Vue.component('state-table', () => import('../components/system/state/StateTable.vue'))
Vue.component('state-save', () => import('../components/system/state/StateSave.vue'))

Vue.component('currency-table', () => import('../components/system/currency/CurrencyIndex.vue'))
Vue.component('currency-save', () => import('../components/system/currency/CurrencySave.vue'))

Vue.component('category-table', () => import('../components/catalog/category/CategoryTable.vue'))
Vue.component('category-save', () => import('../components/catalog/category/CategorySave.vue'))

Vue.component('configuration-save', () => import('../components/system/configuration/ConfigurationSave.vue'))

Vue.component('menu-save', () => import('../components/cms/menu/MenuSave.vue'))
Vue.component('menu-table', () => import('../components/cms/menu/MenuTable.vue'))

Vue.component('page-table', () => import('../components/cms/page/PageTable.vue'))
Vue.component('page-save', require('../components/cms/page/PageSave.vue').default)

Vue.component('order-status-table', () => import('../components/order/order-status/OrderStatusTable.vue'))
Vue.component('order-status-save', () => import('../components/order/order-status/OrderStatusSave.vue'))

Vue.component('role-index', () => import('../components/system/role/RoleTable.vue'))
Vue.component('system-role-save', () => import('../components/system/role/RoleSave.vue'))

Vue.component('admin-user-table', () => import('../components/system/admin-user/AdminUserTable.vue'))
Vue.component('admin-user-save', require('../components/system/admin-user/AdminUserSave.vue').default)

Vue.component('promotion-code-table', () => import('../components/promotion/promotion-code/PromotionCodeTable.vue'))
Vue.component('promotion-code-edit', () => import('../components/promotion/promotion-code/PromotionCodeEdit.vue'))

Vue.component('avored-layout', () => import('../components/system/Layout.vue'))
Vue.component('avored-flash', () => import('../components/system/Flash.vue'))
Vue.component('login-fields', require('../components/system/LoginFields.vue').default)
Vue.component('password-reset-page', () => import('../components/system/PasswordResetPage.vue'))
Vue.component('password-new-page', () => import('../components/system/PasswordNewPage.vue'))




const app = new Vue({
    el: '#app',
    //router,
    //i18n,
    //apolloProvider
});

export const EventBus = new Vue();
