
require('./bootstrap');

// Broadcasting
import Pusher from "pusher-js";
import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '65b34cb2997ed6089c2a',
    cluster: 'us2',
    encrypted: true
});
