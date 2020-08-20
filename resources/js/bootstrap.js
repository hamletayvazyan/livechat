window._ = require('lodash');
window.io = require('socket.io-client');

try {
    window.Popper = require('popper.js').default;
} catch (e) {}
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.async = true;

const personal_token = localStorage.getItem('token');
if (personal_token){
    window.axios.defaults.headers.common['Authorization'] =`Bearer ${personal_token}`;
}

import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');
// console.log(document.getElementsByName('csrf-token')[0].attributes.content.value);
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    // key: process.env.MIX_PUSHER_APP_KEY,
    // cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    // forceTLS: true
    csrfToken: document.getElementsByName('csrf-token')[0].attributes.content.value
    // https://www.learn2torials.com/a/setup-socket-io-with-laravel             using node js! no echo
    // https://laracasts.com/discuss/channels/javascript/laravel-echo-listening-is-not-receiving-data
    // https://laracasts.com/discuss/channels/laravel/laravel-echo-redis-socketio-echo-doesnt-catch-the-event

    // https://www.freecodecamp.org/news/how-to-use-laravel-with-socket-io-e7c7565cc19d/

    // https://webmobtuts.com/backend-development/demonstrating-laravel-echo-socket-io-and-redis-with-real-world-example/

});
