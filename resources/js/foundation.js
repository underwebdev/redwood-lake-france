try {
    window.$ = window.jQuery = require('jquery');

    require('foundation-sites');
} catch (e) {}



$(document).foundation(); // initialize foundation
