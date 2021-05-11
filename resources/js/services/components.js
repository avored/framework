/*************** AVORED VUE COMPONENTS ***************/


window.EventBus = new Vue()

Vue.component('avored-table', require('./components/AvoRedTable').default)
Vue.component('avored-input', require('./components/AvoRedInput').default)
Vue.component('avored-upload', require('./components/AvoRedUpload').default)
Vue.component('avored-select', require('./components/AvoRedSelect').default)
Vue.component('avored-toggle', require('./components/AvoRedToggle').default)
Vue.component('avored-tabs', require('./components/AvoRedTabs').default)
Vue.component('avored-tab', require('./components/AvoRedTab').default)
Vue.component('avored-modal', require('./components/AvoRedModal').default)
Vue.component('avored-dropdown', require('./components/AvoRedDropdown').default)

Vue.component('avored-menu', require('../modules/system/components/layout/Menu').default)


Vue.component('avored-alert', require('./components/AvoRedAlert').default)
Vue.component('avored-confirm', require('./components/AvoRedConfirm').default)

const confirm = params => {
    window.EventBus.$emit('confirmOpen', params)
}

Vue.prototype.$confirm = confirm
Vue['$confirm'] = confirm


const alert = params => {
    window.EventBus.$emit('open', params)
}

Vue.prototype.$alert = alert
Vue['$alert'] = alert


Vue.component('avored-new-customer-report', require('../modules/system/components/report/NewCustomer.vue').default)

import Zondicon from 'vue-zondicons'
Vue.component('zondicon', Zondicon)
