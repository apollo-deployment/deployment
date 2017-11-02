
require('bootstrap-sass');

// Variable setting
window.$ = window.jQuery = require('jquery');

// Handles CSRF token
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};