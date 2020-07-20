/*************** AVORED VUE COMPONENTS ***************/

Vue.component('avored-table', require('@/modules/system/components/forms/AvoRedTable').default)
Vue.component('avored-input', require('@/modules/system/components/forms/AvoRedInput').default)
Vue.component('avored-upload', require('@/modules/system/components/forms/AvoRedUpload').default)
Vue.component('avored-select', require('@/modules/system/components/forms/AvoRedSelect').default)
Vue.component('avored-toggle', require('@/modules/system/components/forms/AvoRedToggle').default)
Vue.component('avored-tabs', require('@/modules/system/components/forms/AvoRedTabs').default)
Vue.component('avored-tab', require('@/modules/system/components/forms/AvoRedTab').default)
Vue.component('avored-modal', require('@/modules/system/components/forms/AvoRedModal').default)


Vue.component('avored-menu', require('@/modules/system/components/layout/Menu').default)

// import VueConfirmDialog from 'vue-confirm-dialog'
// Vue.use(VueConfirmDialog)
// Vue.component('vue-confirm-dialog', VueConfirmDialog.default)


import Alert from '@/modules/system/components/forms/alert'
Vue.use(Alert)

import Confirm from '@/modules/system/components/forms/confirm'
Vue.use(Confirm)

