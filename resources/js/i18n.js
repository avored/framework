import Vue from 'vue'
import Vuei18n from 'vue-i18n'
Vue.use(Vuei18n)

export const i18n = new Vuei18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages: {}
})
