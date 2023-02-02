// window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import feather from 'feather-icons'
import axios from 'axios'
import _ from 'lodash'
import easymde from 'easymde'

window.easymde = easymde
window.axios = axios
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import Alpine from 'alpinejs'
window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
    Alpine.data('toggle', () => ({
        value: null,
        checkedValue: null,
        unCheckedValue: null,
        init(value = false, checkedValue = true, unCheckedValue = false) {
            this.checkedValue = checkedValue
            this.unCheckedValue = unCheckedValue
            this.value = value
        },
        toggle() {
            console.log(this.value)
            if (this.value === this.checkedValue) {
                this.value = this.unCheckedValue
            } else if (this.value === this.unCheckedValue) {
                this.value = this.checkedValue
            }

        }
    }))


    Alpine.data('select2', () => ({
        options: [],
        selected: [],
        show: false,
        open() { this.show = true },
        close() { this.show = false },
        isOpen() { return this.show === true },
        select(index, event) {

            if (!this.options[index].selected) {

                this.options[index].selected = true;
                this.options[index].element = event.target;
                this.selected.push(index);

            } else {
                this.selected.splice(this.selected.lastIndexOf(index), 1);
                this.options[index].selected = false
            }
        },
        remove(index, option) {
            this.options[option].selected = false;
            this.selected.splice(index, 1);


        },
        loadOptions(id) {
            const options = document.getElementById(id).options;
            for (let i = 0; i < options.length; i++) {
                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected: (options[i].selected === true)
                });
                if (options[i].selected === true) {
                    this.selected.push(i)
                }
            }
        },
        selectedValues(){
            return this.selected.map((option)=>{
                return this.options[option].value;
            })
        }

    }))
})



Alpine.data('app', () => ({
    showConfirmationModal: false,
    message: {},
    showConfirmationModal: false,
    modal: {},
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
    activateTab(key) {
        this.activeTab = key
    },
    showAlert(type) {
        this.openAlertBox = true
        this.showAlert = true
        this.showAlertMessage = 'test message'
        console.log(type)
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
    toggleConfirmationDialog(val, modal = null, message = '', url = '') {
        if (modal) {
            this.modal = modal
            this.deleteUrl = url
            this.message = message
        }
        this.showConfirmationModal = val
    },
    confirmation() {
        axios.delete(this.deleteUrl)
            .then((response) => {
                if (response.data.success) {
                    location.reload()
                    this.showAlert = true
                    this.showAlertMessage = response.data.message
                }
            })
        this.showConfirmationModal = false
    },
    init() {
        console.log('sdfds')
    }
}))

feather.replace()
