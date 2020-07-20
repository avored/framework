import AvoRedConfirm from './AvoRedConfirm.vue'

export default {
    install(Vue, args = {}) {
        if (this.installed) return

        this.installed = true
        this.params = args

        Vue.component('avored-confirm', AvoRedConfirm)

        const confirm = params => {
            EventBus.$emit('confirmOpen', params)
        }
       
        Vue.prototype.$confirm = confirm
        Vue['$confirm'] = confirm
    }
}
