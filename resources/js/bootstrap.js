// window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import feather from 'feather-icons'
import axios from 'axios'

window.axios = axios
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import Alpine from 'alpinejs'
window.Alpine = Alpine

Alpine.data('app', () => ({
    showConfirmationModal: false,
    message: {},
    showConfirmationModal: false,
    message: {},
    openAlertBox: false,
    alertBackgroundColor: '',
    alertMessage: '',
    successIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
    infoIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
    warningIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
    dangerIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>`,
    defaultInfoMessage: `This alert contains info message.`,
    defaultSuccessMessage: `This alert contains success message.`,
    defaultWarningMessage: `This alert contains warning message.`,
    defaultDangerMessage: `This alert contains danger message.`,
    activeTab: 'catalog.category.info',
    activateTab(key) {
        this.activeTab = key
    },
    showAlert(type) {
        this.openAlertBox = true
        switch (type) {
            case 'success':
                this.alertBackgroundColor = 'bg-green-500'
                this.alertMessage = `${this.successIcon} ${this.defaultSuccessMessage}`
                break
            case 'info':
                this.alertBackgroundColor = 'bg-blue-500'
                this.alertMessage = `${this.infoIcon} ${this.defaultInfoMessage}`
                break
            case 'warning':
                this.alertBackgroundColor = 'bg-yellow-500'
                this.alertMessage = `${this.warningIcon} ${this.defaultWarningMessage}`
                break
            case 'danger':
                this.alertBackgroundColor = 'bg-red-500'
                this.alertMessage = `${this.dangerIcon} ${this.defaultDangerMessage}`
                break
        }
        this.openAlertBox = true
    },
    toggleConfirmationDialog(val, modal = null) {
        if (modal) {
            this.modal = modal
            this.message = 'Do you really want to delete ' + modal.name + ' category \n' + 'This process cannot be undone'
        }
        this.showConfirmationModal = val
    },
    confirmation() {
        axios.delete('/admin/category/' + this.modal.id)
            .then((response) => {
                if (response.data.success) {
                    location.reload()
                    this.showAlert = true
                    this.showAlertMessage = response.data.message
                }
            })
        this.showConfirmationModal = false
    }
}))
console.log('here')
feather.replace()