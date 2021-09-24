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
console.log('here')
feather.replace()