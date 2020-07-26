window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('@popperjs/core');
    //window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
    window.laravel_echo_port= process.env.LARAVEL_ECHO_PORT;


    require('bootstrap');
    require('admin-lte');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    //encrypted: false,
    wsHost: window.location.hostname,
    wsPort: process.env.LARAVEL_WEBSOCKETS_PORT,
    wssPort: process.env.LARAVEL_WEBSOCKETS_PORT,
    disableStats: true,
    enabledTransports: ['ws', 'flash', 'wss']
});
/*window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '61b2d97890526345bd88',
    cluster: 'eu',
    //encrypted: false,
    wsHost: window.location.hostname,
    wsPort: 6002,
    wssPort: 6002,
    disableStats: true,
    enabledTransports: ['ws', 'flash', 'wss']
});*/

/*
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'your key',
    cluster: 'your cluster',
    encrypted: true,
    auth: {
        headers: {
            Authorization: 'Bearer ' + YourTokenLogin
        },
    },
});*/
