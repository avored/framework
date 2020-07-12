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




import i18n from './services/i18n'
// import apolloProvider from './services/apollo'
// import Router from './services/router'
import Store from './services/store'
import './services/components'

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

import AntDatePicker from 'ant-design-vue/lib/date-picker'

Vue.component('a-date-picker', AntDatePicker)
Vue.component('a-icon', require('ant-design-vue/lib/icon').default)
Vue.component('a-avatar', require('ant-design-vue/lib/avatar').default)
Vue.component('a-divider', require('ant-design-vue/lib/divider').default)
Vue.component('a-row', require('ant-design-vue/lib/row').default)
Vue.component('a-col', require('ant-design-vue/lib/col').default)
Vue.component('a-drawer', require('ant-design-vue/lib/drawer').default)
Vue.component('a-card', require('ant-design-vue/lib/card').default)
Vue.component('a-button', require('ant-design-vue/lib/button').default)
Vue.component('a-upload', require('ant-design-vue/lib/upload').default)
Vue.component('a-upload', require('ant-design-vue/lib/upload').default)
Vue.component('a-input', require('ant-design-vue/lib/input').default)
Vue.component('a-switch', require('ant-design-vue/lib/switch').default)
Vue.component('a-tag', require('ant-design-vue/lib/tag').default)

Vue.prototype.$notification = Notification;
Vue.prototype.$confirm = Modal.confirm;
Vue.prototype.$info = Modal.info;
Vue.prototype.$success = Modal.success;
Vue.prototype.$error = Modal.error;
Vue.prototype.$warning = Modal.warning;
Vue.prototype.$confirm = Modal.confirm;


window.EventBus = new Vue()

import Vddl from 'vddl'
Vue.use(Vddl)

Vue.component('order-table', require('../components/order/order/OrderTable.vue').default)

Vue.component('language-table', require('../components/system/language/LanguageTable.vue').default)
Vue.component('language-save', require('../components/system/language/LanguageSave.vue').default)


Vue.component('user-group-table', require('../components/user/user-group/UserGroupTable.vue').default)
Vue.component('user-group-save', require('../components/user/user-group/UserGroupSave.vue').default)

Vue.component('tax-group-table', require('../components/system/tax-group/TaxGroupTable.vue').default)
Vue.component('tax-group-save', require('../components/system/tax-group/TaxGroupSave.vue').default)

Vue.component('tax-rate-table', require('../components/system/tax-rate/TaxRateTable.vue').default)
Vue.component('tax-rate-save', require('../components/system/tax-rate/TaxRateSave.vue').default)

Vue.component('attribute-table', require('../components/catalog/attribute/AttributeTable.vue').default)
Vue.component('attribute-save', require('../components/catalog/attribute/AttributeSave.vue').default)
Vue.component('property-table', require('../components/catalog/property/PropertyTable.vue').default)
Vue.component('property-save', require('../components/catalog/property/PropertySave.vue').default)

Vue.component('product-table', require('../components/catalog/product/ProductTable.vue').default)
Vue.component('product-save', require('../components/catalog/product/ProductSave.vue').default)

Vue.component('state-table', require('../components/system/state/StateTable.vue').default)
Vue.component('state-save', require('../components/system/state/StateSave.vue').default)

Vue.component('currency-table', require('../components/system/currency/CurrencyTable.vue').default)
Vue.component('currency-save', require('../components/system/currency/CurrencySave.vue').default)

Vue.component('category-table', require('../components/catalog/category/CategoryTable.vue').default)
Vue.component('category-save', require('../components/catalog/category/CategorySave.vue').default)

Vue.component('configuration-save', require('../components/system/configuration/ConfigurationSave.vue').default)

Vue.component('menu-save', require('../components/cms/menu/MenuSave.vue').default)
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


import Zondicon from 'vue-zondicons'

Vue.component('zondicon', Zondicon)

const app = new Vue({
    el: '#app',
    //router,
    i18n,
    store: Store,
    //apolloProvider
});
