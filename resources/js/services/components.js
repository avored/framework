/*************** AVORED VUE COMPONENTS ***************/

import { 
    AvoRedInput,
    AvoRedTable,
    AvoRedUpload,
    AvoRedSelect,
    AvoRedToggle,
    AvoRedTabs,
    AvoRedTab,
    AvoRedModal,
    AvoRedAlert,
    AvoRedConfirm,
    AvoRedDropdown
} from 'avored-components'

Vue.component('avored-table', AvoRedTable)
Vue.component('avored-input', AvoRedInput)
Vue.component('avored-upload', AvoRedUpload)
Vue.component('avored-select', AvoRedSelect)
Vue.component('avored-toggle', AvoRedToggle)
Vue.component('avored-tabs', AvoRedTabs)
Vue.component('avored-tab', AvoRedTab)
Vue.component('avored-modal', AvoRedModal)
Vue.component('avored-dropdown', AvoRedDropdown)

Vue.component('avored-menu', require('@/modules/system/components/layout/Menu').default)

Vue.use(AvoRedAlert)
Vue.use(AvoRedConfirm)


Vue.component('avored-new-customer-report', require('@/modules/system/components/report/NewCustomer.vue').default)

import Zondicon from 'vue-zondicons'
Vue.component('zondicon', Zondicon)
