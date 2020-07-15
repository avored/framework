
window.Vue = require('vue')

window.AvoRed = (function() {
    return {
        initialize: function(callback) {
            callback(window.Vue)
        }
    };
})();


exports = module.exports = AvoRed;
