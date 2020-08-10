window._ = require('lodash');
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

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
