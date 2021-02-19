import Vue from 'vue'

window.Vue = Vue

window.EventBus = new Vue()

window.AvoRed = (function() {
    return {
        initialize: function(callback) {
            callback(window.Vue)
        }
    };
})();

export default AvoRed
