
require('bootstrap-sass');


window._ = require('lodash');

window.$ = window.jQuery = require('jquery');

// CSRF Token
window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};