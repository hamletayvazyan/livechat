window._ = require('lodash');
try {
    window.Popper = require('popper.js').default;
} catch (e) {}
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.async = true;

// const personal_token = localStorage.getItem('token');
// if (personal_token){
//     window.axios.defaults.headers.common['Authorization'] =`Bearer ${personal_token}`;
// }

import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');
window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    // key: process.env.MIX_PUSHER_APP_KEY,
    // cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    // forceTLS: true

    // https://www.freecodecamp.org/news/how-to-use-laravel-with-socket-io-e7c7565cc19d/

    // https://webmobtuts.com/backend-development/demonstrating-laravel-echo-socket-io-and-redis-with-real-world-example/


    // listenForBroadcast(survey_id) {
    //     Echo.join('survey.' + survey_id)
    //         .here((users) => {
    //             this.users_viewing = users;
    //             this.$forceUpdate();
    //         })
    //         .joining((user) => {
    //             if (this.checkIfUserAlreadyViewingSurvey(user)) {
    //                 this.users_viewing.push(user);
    //                 this.$forceUpdate();
    //             }
    //         })
    //         .leaving((user) => {
    //             this.removeViewingUser(user);
    //             this.$forceUpdate();
    //         });
    // },
});
